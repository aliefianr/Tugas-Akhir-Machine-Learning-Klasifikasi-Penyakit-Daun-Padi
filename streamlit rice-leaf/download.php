<?php
// Path file model
$files = [
    "XGBoost Model" => "python_model/xgb_best_model.pkl",
    //"DenseNet Features" => "python_model/densenet201_features.h5" // kalau ada
];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Download Model</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-4">

    <h4>Download Model ML</h4>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted mb-0">
          Unduh file model yang digunakan dalam sistem deteksi penyakit daun padi.
        File ini dapat digunakan untuk deployment, eksperimen, atau backup.
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

    <div class="list-group">
        <?php foreach ($files as $name => $path): ?>
            <?php if (file_exists(__DIR__ . "/" . $path)): ?>
                <a href="<?= $path ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" download>
                    <?= $name ?>
                    <span class="badge badge-primary badge-pill"><?= filesize(__DIR__ . "/" . $path)/1024 ?> KB</span>
                </a>
            <?php else: ?>
                <div class="list-group-item list-group-item-warning">
                    <?= $name ?> - File tidak ditemukan
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
