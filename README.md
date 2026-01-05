# 🌾 Klasifikasi Penyakit Daun Padi (Rice Leaf Disease Detection)

![Python](https://img.shields.io/badge/Python-3.8%2B-blue)
![TensorFlow](https://img.shields.io/badge/Feature%20Extractor-DenseNet201-orange)
![XGBoost](https://img.shields.io/badge/Classifier-XGBoost-green)
![Streamlit](https://img.shields.io/badge/Deployment-Streamlit-red)

**Oleh : Aliefian Ramadhan (22081010171)
Kelas : Machine Learning**

Repositori ini berisi kode sumber dan laporan Tugas Akhir mengenai deteksi penyakit pada daun padi menggunakan metode **Hybrid Deep Learning**.

Sistem ini menggabungkan **DenseNet201** (sebagai ekstraktor fitur) dan **XGBoost** (sebagai pengklasifikasi), serta dilengkapi antarmuka web interaktif berbasis **Streamlit**.

## 📌 Fitur Utama
- **Deteksi 4 Kelas**: BrownSpot, Healthy, Hispa, LeafBlast.
- **Metode Hybrid**: Menggabungkan akurasi Deep Learning dengan efisiensi XGBoost.
- **Explainability**: Visualisasi area fokus prediksi menggunakan **Grad-CAM**.
- **Streamlit App**: Antarmuka sederhana untuk upload gambar dan melihat hasil prediksi.

## 📂 Struktur File

| Nama File | Deskripsi |
| :--- | :--- |
| `Kode_ML_Padi_Aliefian.ipynb` | Notebook utama berisi preprocessing, training model, evaluasi, dan visualisasi. |
| `Laporan Akhir ML Aliefian Ramadhan.pdf` | Laporan lengkap tugas akhir (PDF). |
| `Link Dataset` | Link untuk download dataset. |
| `Slide ML Aliefian Ramadhan.pptx` | Slide presentasi projek |
| `app.py` | Source code aplikasi Streamlit untuk deployment. |
| `xgb_best_model.pkl` | File model hasil training. File ini dihasilkan dari notebook dan wajib satu folder dengan `app.py`. |

## 📊 Performa Model
Berdasarkan hasil pengujian pada dataset, model Hybrid (DenseNet201 + Tuned XGBoost) memberikan hasil terbaik:

| Model | Akurasi | Keterangan |
| :--- | :--- | :--- |
| **XGBoost (Tuned)** | **74.66%** | Model yang digunakan di aplikasi ini. |
| Logistic Regression | 70.49% | Baseline model. |
| Random Forest | 67.21% | Pembanding. |

## 🚀 Cara Instalasi

1. Setup Folder Project
Letakkan folder project rice-leaf di dalam direktori htdocs XAMPP: C:\xampp\htdocs\rice-leaf

3. Setup Python Environment
Buka Terminal/CMD, lalu arahkan ke folder python_model:

```cd C:\xampp\htdocs\rice-leaf\python_model```
Buat dan aktifkan Virtual Environment:

```python -m venv venv```

```.\venv\Scripts\activate```

5. Install Library
Install dependencies dengan versi yang kompatibel

```pip install "numpy<2.0" "tensorflow<2.11" opencv-python xgboost scikit-learn matplotlib shap joblib Pillow```

## 🖥️ Cara Menjalankan
Buka XAMPP Control Panel, Start module Apache.

Buka browser dan akses: http://localhost/rice-leaf/
