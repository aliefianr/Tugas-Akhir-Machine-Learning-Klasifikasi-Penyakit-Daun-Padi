<?php
$outputDir = __DIR__ . "/python_model/explain";

$summaryPlot = "$outputDir/shap_summary.png";
$barPlot = "$outputDir/shap_bar.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Explainability SHAP</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    
    <h4>Model Explainability (SHAP)</h4>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted mb-0">
            Visualisasi kontribusi fitur dari model XGBoost menggunakan SHAP.
        </p>
        <a href="index.php" class="btn btn-outline-secondary btn-sm">
            Home
        </a>
    </div>

       <!-- NAVIGATION -->
    <div class="card shadow-sm mb-4">
        <div class="card-body text-center">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <a href="predict.php" class="btn btn-success btn-block">Prediksi</a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="evaluate.php" class="btn btn-primary btn-block">Evaluasi</a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="explain.php" class="btn btn-secondary btn-block">Explain</a>
                </div>
                <div class="col-md-3 mb-2">
                    <a href="download.php" class="btn btn-danger btn-block">Download</a>
                </div>
            </div>
        </div>
    </div>
    <!-- SHAP SUMMARY PLOT -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            SHAP Summary Plot
        </div>
        <div class="card-body text-center">
            <?php if (file_exists($summaryPlot)): ?>
                <img src="python_model/explain/shap_summary.png" class="img-fluid" alt="SHAP Summary">
            <?php else: ?>
                <div class="alert alert-warning">
                    Summary plot belum tersedia. Jalankan <b>python_model/explain.py</b> terlebih dahulu.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- SHAP BAR PLOT -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            SHAP Bar Plot
        </div>
        <div class="card-body text-center">
            <?php if (file_exists($barPlot)): ?>
                <img src="python_model/explain/shap_bar.png" class="img-fluid" alt="SHAP Bar">
            <?php else: ?>
                <div class="alert alert-warning">
                    Bar plot belum tersedia. Jalankan <b>python_model/explain.py</b> terlebih dahulu.
                </div>
            <?php endif; ?>
        </div>
    </div>



</div>

</body>
</html>
