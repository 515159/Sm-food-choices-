# AI-Powered Phishing Email Detection System

This is a standalone Flask + scikit-learn app for detecting whether pasted email text looks like phishing or legitimate mail.

## Project Structure

```text
phishing_detector/
  app.py                 Flask web app
  train_model.py         Trains and saves the ML model/vectorizer
  text_processing.py     Shared email cleaning logic
  requirements.txt       Python dependencies
  data/sample_emails.csv Small demo dataset
  models/                Created after training
  templates/index.html   Web UI
  static/styles.css      Web UI styling
```

## Setup

```bash
cd phishing_detector
python -m venv .venv
.venv\Scripts\activate
pip install -r requirements.txt
python train_model.py
python app.py
```

Open `http://127.0.0.1:5000` in your browser.

## Training With Your Own Dataset

Use a CSV file with:

- `text`: full email body or subject/body text
- `label`: either `phishing` or `legitimate`

Then run:

```bash
python train_model.py --dataset path\to\emails.csv
```

The script writes:

- `models/phishing_model.joblib`
- `models/tfidf_vectorizer.joblib`
- `models/metrics.json`

## Notes

The included dataset is intentionally tiny so the app can be demonstrated immediately. For real detection quality, train with a large, labeled dataset from sources such as Kaggle, UCI, or an internal security mailbox export.
