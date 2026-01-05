import os
import json
import joblib
import numpy as np
import cv2
import matplotlib.pyplot as plt
import tensorflow as tf

from tensorflow.keras.applications import DenseNet201
from tensorflow.keras.applications.densenet import preprocess_input
from sklearn.metrics import (
    accuracy_score,
    precision_score,
    recall_score,
    f1_score,
    confusion_matrix,
    ConfusionMatrixDisplay
)

# ===== PATH =====
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
DATASET_DIR = os.path.join(BASE_DIR, "dataset_test")
MODEL_PATH = os.path.join(BASE_DIR, "xgb_best_model.pkl")
RESULT_DIR = os.path.join(BASE_DIR, "../results")
os.makedirs(RESULT_DIR, exist_ok=True)

# ===== CLASSES (SESUIAIKAN DENGAN FOLDER) =====
CLASSES = {
    "_BrownSpot": 0,
    "_Healthy": 1,
    "_Hispa": 2,
    "_LeafBlast": 3
}

IMG_SIZE = 224

# ===== LOAD MODELS =====
xgb_model = joblib.load(MODEL_PATH)

feature_extractor = DenseNet201(
    weights="imagenet",
    include_top=False,
    pooling="avg"
)

X = []
y_true = []

# ===== LOAD DATASET =====
for folder, label in CLASSES.items():
    folder_path = os.path.join(DATASET_DIR, folder)
    if not os.path.isdir(folder_path):
        continue

    for file in os.listdir(folder_path):
        img_path = os.path.join(folder_path, file)

        img = cv2.imread(img_path)
        if img is None:
            continue

        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        img = cv2.resize(img, (IMG_SIZE, IMG_SIZE))
        img = np.expand_dims(img, axis=0)
        img = preprocess_input(img)

        feature = feature_extractor.predict(img, verbose=0)
        X.append(feature[0])
        y_true.append(label)

X = np.array(X)
y_true = np.array(y_true)

# ===== PREDICT =====
y_pred = xgb_model.predict(X)

# ===== METRICS =====
metrics = {
    "total_samples": int(len(y_true)),
    "accuracy": float(accuracy_score(y_true, y_pred)),
    "precision": float(precision_score(y_true, y_pred, average="weighted")),
    "recall": float(recall_score(y_true, y_pred, average="weighted")),
    "f1_score": float(f1_score(y_true, y_pred, average="weighted"))
}

with open(os.path.join(RESULT_DIR, "metrics.json"), "w") as f:
    json.dump(metrics, f, indent=4)

# ===== CONFUSION MATRIX =====
labels = ["BrownSpot", "Healthy", "Hispa", "LeafBlast"]
cm = confusion_matrix(y_true, y_pred)

disp = ConfusionMatrixDisplay(confusion_matrix=cm, display_labels=labels)
disp.plot(cmap="Blues", xticks_rotation=45)

plt.title("Confusion Matrix (Test Dataset)")
plt.tight_layout()
plt.savefig(os.path.join(RESULT_DIR, "confusion_matrix.png"))
plt.close()

print("Evaluation completed successfully")
