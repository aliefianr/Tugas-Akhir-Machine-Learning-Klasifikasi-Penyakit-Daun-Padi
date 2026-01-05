import sys, json
import numpy as np
import joblib
import os
from PIL import Image
from tensorflow.keras.applications import DenseNet201
from tensorflow.keras.applications.densenet import preprocess_input
import warnings

# ===== MATIKAN LOG =====
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'  # TensorFlow
warnings.filterwarnings("ignore")         # Python warnings

# Paksa stdout bersih
sys.stdout.reconfigure(encoding='utf-8')

CLASSES = ["BrownSpot", "Healthy", "Hispa", "LeafBlast"]

feature_extractor = DenseNet201(
    weights="imagenet",
    include_top=False,
    pooling="avg",
    input_shape=(224,224,3)
)


BASE_DIR = os.path.dirname(os.path.abspath(__file__))
MODEL_PATH = os.path.join(BASE_DIR, "xgb_best_model.pkl")

classifier = joblib.load(MODEL_PATH)



results = []

for img_path in sys.argv[1:]:
    img = Image.open(img_path).convert("RGB").resize((224,224))
    arr = preprocess_input(np.expand_dims(np.array(img), axis=0))

    feat = feature_extractor.predict(arr)
    probs = classifier.predict_proba(feat)[0]
    idx = np.argmax(probs)

    results.append({
        "file": img_path.split("\\")[-1],
        "prediction": CLASSES[idx],
        "confidence": float(probs[idx]),
        "probs": probs.tolist()
    })

print(json.dumps(results))
