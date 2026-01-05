<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌾 Rice Leaf Disease Detection</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
          crossorigin="anonymous">
    <style>
        .jumbotron {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .feature-card:hover {
            transform: translateY(-3px);
            transition: 0.3s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .btn-feature {
            font-weight: bold;
            font-size: 1rem;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">

    <!-- HEADER -->
    <div class="jumbotron bg-success text-white text-center">
        <h1>🌾 Rice Leaf Disease Detection</h1>
        <p class="lead">
            Sistem deteksi penyakit daun padi menggunakan citra digital<br>
            dengan metode <b>Hybrid Deep Learning</b>: <b>DenseNet201 + XGBoost</b>.
        </p>
    </div>

<div class="row mb-4">
    
    <div class="col-md-6 mb-2">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                
                <p><b>Oleh : </b>Aliefian Ramadhan (22081010171) – <b>Kelas:</b> Machine Learning</p>
                
                <p style="text-align: justify;">Tugas Akhir mengenai deteksi penyakit pada daun padi menggunakan metode Hybrid Deep Learning. Sistem ini menggabungkan DenseNet201 (sebagai ekstraktor fitur) dan XGBoost (sebagai pengklasifikasi), serta dilengkapi antarmuka web interaktif berbasis Streamlit.</p>
            </div>
        </div>
    </div>


    <div class="col-md-6 mb-2">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <p><b>Dataset:</b> 4 Kelas Penyakit Daun Padi</p>
            <ul>
                <li>BrownSpot</li>
                <li>Healthy</li>
                <li>Hispa</li>
                <li>LeafBlast</li>
            </ul>

            <!-- TOMBOL LINK -->
            <div class="">
                <a href="https://github.com/aliefianr/Tugas-Akhir-Machine-Learning-Klasifikasi-Penyakit-Daun-Padi" target="_blank" class="btn btn-dark btn-sm">
                    GitHub
                </a>
            </div>
        </div>
    </div>
</div>

</div>


<!-- FITUR UTAMA -->
<div class="row text-center">
    <!-- Prediksi -->
    <div class="col-md-3 mb-3">
        <a href="predict.php" class="text-decoration-none">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success">
                    <b class="text-white">Prediksi</b>
                </div>
                <div class="card-body">
                    <p class="text-dark mb-0">Upload gambar daun padi dan prediksi kelas penyakit dari daun.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Evaluasi -->
    <div class="col-md-3 mb-3">
        <a href="evaluate.php" class="text-decoration-none">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary">
                    <b class="text-white">Evaluasi</b>
                </div>
                <div class="card-body">
                    <p class="text-dark mb-0">Lihat metrics model, accuracy, precision, recall, F1-score, dan confusion matrix.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Explainability -->
    <div class="col-md-3 mb-3">
        <a href="explain.php" class="text-decoration-none">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary">
                    <b class="text-white">Explainability</b>
                </div>
                <div class="card-body">
                    <p class="text-dark mb-0">Tampilkan SHAP top features dan visualisasi kontribusi fitur prediksi.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Download -->
    <div class="col-md-3 mb-3">
        <a href="download.php" class="text-decoration-none">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-danger">
                    <b class="text-white">Download</b>
                </div>
                <div class="card-body">
                    <p class="text-dark mb-0">Unduh file model yang digunakan dalam sistem deteksi penyakit daun padi.</p>
                </div>
            </div>
        </a>
    </div>
</div>



</div>

</body>
</html>
