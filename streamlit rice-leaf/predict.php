<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$results = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_FILES["images"])) {
        $error = "File tidak terbaca oleh PHP";
    } else {

        $uploadDir = __DIR__ . "/uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $paths = [];
        foreach ($_FILES["images"]["tmp_name"] as $i => $tmp) {
            if ($tmp == "") continue;
            $name = basename($_FILES["images"]["name"][$i]);
            $safeName = str_replace(" ", "_", $name);
            $path = $uploadDir . $safeName;
            move_uploaded_file($tmp, $path);
            $paths[] = $path;
        }

        if (count($paths) === 0) {
            $error = "Tidak ada file yang berhasil diupload";
        } else {
            $python = "C:\\xampp\\htdocs\\rice-leaf\\python_model\\venv\\Scripts\\python.exe";
            $script = "C:\\xampp\\htdocs\\rice-leaf\\python_model\\predict.py";

            $cmd = "\"$python\" \"$script\"";
            foreach ($paths as $p) $cmd .= " \"$p\"";

            $output = shell_exec($cmd . " 2>&1");

            if ($output === null) {
                $error = "shell_exec tidak jalan. Cek php.ini";
            } else {
                if (preg_match('/(\[\s*\{.*\}\s*\])/s', $output, $match)) {
                    $results = json_decode($match[1], true);
                    if (!is_array($results)) $error = "Hasil prediksi tidak valid.";
                } else {
                    $error = "Model berjalan, tetapi hasil prediksi tidak ditemukan.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Run Model</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .img-preview { max-height: 100px; margin-right: 5px; margin-bottom: 5px; border:1px solid #ccc; padding:2px; }
        
    </style>
</head>
<body class="bg-light">

<div class="container mt-4">

    <h4 >Run Classification Model</h3>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted mb-0">
          Prediksi penyakit pada gambar menggunakan model.
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

   
<form method="POST" enctype="multipart/form-data" class="mb-4">
    <div class="form-row align-items-center">
        <div class="col-md-9 mb-2">
            <input type="file" name="images[]" multiple required class="form-control">
        </div>
        <div class="col-md-3 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Predict</button>
        </div>
    </div>
</form>


    <!-- ERROR -->
    <?php if ($error): ?>
        <div class="alert alert-danger"><pre><?= htmlspecialchars($error) ?></pre></div>
    <?php endif; ?>

    

   <!-- HASIL -->
<?php if (is_array($results)): ?>
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            Hasil Prediksi
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm text-center align-middle">
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Prediction</th>
                        <th>Confidence</th>
                        <th>BrownSpot</th>
                        <th>Healthy</th>
                        <th>Hispa</th>
                        <th>LeafBlast</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $r): 
                        $cls = $r["prediction"];
                        $imgSrc = str_replace(__DIR__, '.', $r["file"]);
                    ?>
                    <tr class="class-<?= $cls ?>">
                        <td>
                             <?php if (!empty($paths)): ?>
                            
                                   
                                    <?php foreach ($paths as $p): ?>
                                        <img src="<?= str_replace(__DIR__, '.', $p) ?>" class="img-preview">
                                    <?php endforeach; ?>
                                
                            <?php endif; ?>
                            
                        </td>
                        <td><b><?= htmlspecialchars($cls) ?></b></td>
                        <td><?= round($r["confidence"] * 100, 2) ?>%</td>
                        <?php foreach ($r["probs"] as $p): ?>
                            <td><?= round($p * 100, 2) ?>%</td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

</div>

</body>
</html>
