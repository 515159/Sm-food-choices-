import html
import re
from typing import Iterable


STOP_WORDS = {
    "a",
    "an",
    "and",
    "are",
    "as",
    "at",
    "be",
    "by",
    "for",
    "from",
    "has",
    "have",
    "in",
    "is",
    "it",
    "its",
    "of",
    "on",
    "or",
    "that",
    "the",
    "this",
    "to",
    "was",
    "were",
    "will",
    "with",
    "you",
    "your",
}


def clean_email_text(text: str) -> str:
    """Normalize email text before vectorization."""
    if not text:
        return ""

    text = html.unescape(text)
    text = re.sub(r"<[^>]+>", " ", text)
    text = re.sub(r"https?://\S+|www\.\S+", " urltoken ", text, flags=re.IGNORECASE)
    text = re.sub(r"\b[\w.+-]+@[\w-]+\.[\w.-]+\b", " emailtoken ", text)
    text = re.sub(r"\b\d+\b", " numbertoken ", text)
    text = re.sub(r"[^a-zA-Z\s]", " ", text)
    text = text.lower()

    tokens = [simple_stem(token) for token in text.split() if token not in STOP_WORDS]
    return " ".join(tokens)


def clean_many(texts: Iterable[str]) -> list[str]:
    return [clean_email_text(text) for text in texts]


def simple_stem(token: str) -> str:
    for suffix in ("ingly", "edly", "ing", "edly", "ed", "ly", "es", "s"):
        if len(token) > len(suffix) + 3 and token.endswith(suffix):
            return token[: -len(suffix)]
    return token
