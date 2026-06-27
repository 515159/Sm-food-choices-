import argparse
import json
from pathlib import Path

import joblib
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import accuracy_score, classification_report, confusion_matrix
from sklearn.model_selection import train_test_split

from text_processing import clean_many


BASE_DIR = Path(__file__).resolve().parent
DEFAULT_DATASET = BASE_DIR / "data" / "sample_emails.csv"
MODEL_DIR = BASE_DIR / "models"


def load_dataset(path: Path) -> pd.DataFrame:
    data = pd.read_csv(path)
    required_columns = {"text", "label"}
    missing = required_columns.difference(data.columns)

    if missing:
        raise ValueError(f"Dataset is missing required columns: {', '.join(sorted(missing))}")

    data = data[["text", "label"]].dropna()
    data["label"] = data["label"].str.strip().str.lower()
    data = data[data["label"].isin(["phishing", "legitimate"])]

    if data.empty:
        raise ValueError("Dataset does not contain usable phishing/legitimate rows.")

    return data


def train(dataset_path: Path) -> dict:
    data = load_dataset(dataset_path)
    cleaned_text = clean_many(data["text"].astype(str))
    labels = data["label"]

    stratify = labels if labels.value_counts().min() >= 2 else None
    test_size = 0.2 if len(data) >= 10 else 0.3

    x_train, x_test, y_train, y_test = train_test_split(
        cleaned_text,
        labels,
        test_size=test_size,
        random_state=42,
        stratify=stratify,
    )

    vectorizer = TfidfVectorizer(ngram_range=(1, 2), min_df=1, max_features=12000)
    x_train_vec = vectorizer.fit_transform(x_train)
    x_test_vec = vectorizer.transform(x_test)

    model = LogisticRegression(max_iter=1000, class_weight="balanced")
    model.fit(x_train_vec, y_train)

    predictions = model.predict(x_test_vec)
    metrics = {
        "dataset": str(dataset_path),
        "total_rows": int(len(data)),
        "training_rows": int(len(x_train)),
        "testing_rows": int(len(x_test)),
        "accuracy": float(accuracy_score(y_test, predictions)),
        "confusion_matrix": confusion_matrix(y_test, predictions, labels=["legitimate", "phishing"]).tolist(),
        "classification_report": classification_report(y_test, predictions, output_dict=True, zero_division=0),
    }

    MODEL_DIR.mkdir(exist_ok=True)
    joblib.dump(model, MODEL_DIR / "phishing_model.joblib")
    joblib.dump(vectorizer, MODEL_DIR / "tfidf_vectorizer.joblib")
    (MODEL_DIR / "metrics.json").write_text(json.dumps(metrics, indent=2), encoding="utf-8")

    return metrics


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser(description="Train the phishing email detection model.")
    parser.add_argument("--dataset", type=Path, default=DEFAULT_DATASET, help="CSV with text,label columns.")
    return parser.parse_args()


if __name__ == "__main__":
    args = parse_args()
    result = train(args.dataset.resolve())
    print(f"Model trained on {result['total_rows']} rows.")
    print(f"Accuracy: {result['accuracy']:.3f}")
    print(f"Saved artifacts to {MODEL_DIR}")
