import json
from pathlib import Path

import joblib
from flask import Flask, render_template, request

from text_processing import clean_email_text


BASE_DIR = Path(__file__).resolve().parent
MODEL_PATH = BASE_DIR / "models" / "phishing_model.joblib"
VECTORIZER_PATH = BASE_DIR / "models" / "tfidf_vectorizer.joblib"
METRICS_PATH = BASE_DIR / "models" / "metrics.json"

app = Flask(__name__)


def load_artifacts():
    if not MODEL_PATH.exists() or not VECTORIZER_PATH.exists():
        return None, None

    return joblib.load(MODEL_PATH), joblib.load(VECTORIZER_PATH)


model, vectorizer = load_artifacts()


def load_metrics() -> dict:
    if not METRICS_PATH.exists():
        return {}

    return json.loads(METRICS_PATH.read_text(encoding="utf-8"))


@app.route("/", methods=["GET", "POST"])
def index():
    result = None
    email_text = ""
    error = None
    metrics = load_metrics()

    if request.method == "POST":
        email_text = request.form.get("email_text", "").strip()

        if not email_text:
            error = "Paste an email before scanning."
        elif model is None or vectorizer is None:
            error = "Model files were not found. Run python train_model.py first."
        else:
            cleaned = clean_email_text(email_text)
            features = vectorizer.transform([cleaned])
            prediction = model.predict(features)[0]

            probability = None
            if hasattr(model, "predict_proba"):
                classes = list(model.classes_)
                phishing_index = classes.index("phishing")
                probability = round(float(model.predict_proba(features)[0][phishing_index]) * 100, 2)

            result = {
                "label": prediction,
                "is_phishing": prediction == "phishing",
                "probability": probability,
            }

    return render_template("index.html", result=result, email_text=email_text, error=error, metrics=metrics)


if __name__ == "__main__":
    app.run(debug=True)
