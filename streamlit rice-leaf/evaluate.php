<?php
$metricsFile = __DIR__ . "/results/metrics.json";
$cmImage = "results/confusion_matrix.png";

if (!file_exists($metricsFile)) {
    die("<div class='alert alert-danger'>
            File metrics.json tidak ditemukan.<br>
            Jalankan <b>evaluate.py</b> terlebih dahulu.
         </div>");
}

$metrics = json_decode(file_get_contents($metricsFile), true);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Model Evaluation</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-4">

    <h4>Model Evaluation</h4>
  
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted mb-0">
            Evaluasi performa model klasifikasi penyakit daun padi menggunakan
        dataset uji berlabel.
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
    <!-- METRICS -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            Performance Metrics
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm mb-0">
                <tr>
                    <th>Total Data Uji</th>
                    <td><?= $metrics['total_samples'] ?></td>
                </tr>
                <tr>
                    <th>Accuracy</th>
                    <td><?= round($metrics['accuracy'] * 100, 2) ?>%</td>
                </tr>
                <tr>
                    <th>Precision</th>
                    <td><?= round($metrics['precision'] * 100, 2) ?>%</td>
                </tr>
                <tr>
                    <th>Recall</th>
                    <td><?= round($metrics['recall'] * 100, 2) ?>%</td>
                </tr>
                <tr>
                    <th>F1-score</th>
                    <td><?= round($metrics['f1_score'] * 100, 2) ?>%</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- CONFUSION MATRIX -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            Confusion Matrix
        </div>
        <div class="card-body text-center">
            <?php if (file_exists(__DIR__ . "/results/confusion_matrix.png")): ?>
                <img src="<?= $cmImage ?>" class="img-fluid" alt="Confusion Matrix">
            <?php else: ?>
                <div class="alert alert-warning">
                    File confusion matrix belum tersedia.
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>
