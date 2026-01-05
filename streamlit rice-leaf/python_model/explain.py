import os
import numpy as np
import shap
import joblib
import tensorflow as tf
from tensorflow.keras.applications import DenseNet201
from tensorflow.keras.applications.densenet import preprocess_input
from tensorflow.keras.preprocessing.image import load_img, img_to_array
import matplotlib.pyplot as plt

# =====================
# CONFIG
# =====================
IMG_SIZE = (224, 224)
DATASET_DIR = os.path.join(os.path.dirname(__file__), "dataset_test")  # folder dataset test
MODEL_PATH = os.path.join(os.path.dirname(__file__), "xgb_best_model.pkl")
OUTPUT_DIR = os.path.join(os.path.dirname(__file__), "explain")

os.makedirs(OUTPUT_DIR, exist_ok=True)

CLASS_NAMES = ["BrownSpot", "Healthy", "Hispa", "LeafBlast"]

# =====================
# LOAD MODEL
# =====================
print("[INFO] Loading XGBoost model...")
model = joblib.load(MODEL_PATH)

# =====================
# LOAD DENSENET
# =====================
print("[INFO] Loading DenseNet201...")
base_model = DenseNet201(weights="imagenet", include_top=False, pooling="avg")

# Force eager execution
tf.config.run_functions_eagerly(True)

# =====================
# LOAD IMAGES
# =====================
def load_images():
    X = []
    y = []

    for idx, cls in enumerate(CLASS_NAMES):
        cls_path = os.path.join(DATASET_DIR, f"_{cls}")
        if not os.path.isdir(cls_path):
            print(f"[WARNING] Folder not found: {cls_path}")
            continue

        for img_name in os.listdir(cls_path)[:20]:  # limit biar ringan
            img_path = os.path.join(cls_path, img_name)
            try:
                img = load_img(img_path, target_size=IMG_SIZE)
                img = img_to_array(img)
                img = preprocess_input(img)
                X.append(img)
                y.append(idx)
            except Exception as e:
                print(f"[ERROR] Failed to load {img_path}: {e}")

    X = np.array(X, dtype=np.float32)
    y = np.array(y)
    return X, y

print("[INFO] Loading images...")
X_img, y = load_images()
print(f"[DEBUG] Loaded images: {X_img.shape}, labels: {y.shape}")

if X_img.size == 0:
    raise ValueError("No images found. Check DATASET_DIR and class folders!")

# =====================
# FEATURE EXTRACTION
# =====================
print("[INFO] Extracting features...")
X_feat = base_model.predict(X_img, verbose=1)

# =====================
# SHAP EXPLAINER
# =====================
print("[INFO] Running SHAP...")
explainer = shap.TreeExplainer(model)
shap_values = explainer.shap_values(X_feat)

# =====================
# SHAP SUMMARY PLOT
# =====================
print("[INFO] Saving SHAP summary plot...")
plt.figure()
shap.summary_plot(shap_values, X_feat, show=False, class_names=CLASS_NAMES)
plt.savefig(os.path.join(OUTPUT_DIR, "shap_summary.png"), bbox_inches="tight")
plt.close()

# =====================
# SHAP BAR PLOT
# =====================
print("[INFO] Saving SHAP bar plot...")
plt.figure()
shap.summary_plot(shap_values, X_feat, plot_type="bar", show=False, class_names=CLASS_NAMES)
plt.savefig(os.path.join(OUTPUT_DIR, "shap_bar.png"), bbox_inches="tight")
plt.close()

print("✅ Explainability plots generated successfully in 'explain/' folder")
