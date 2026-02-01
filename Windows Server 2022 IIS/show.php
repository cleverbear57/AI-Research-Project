<?php
/* =====================
FILE: show.php
===================== */

// Absolute path to uploads folder
$uploadDir = 'C:\uploads';  // Must match your PowerShell setup
$webPath = '/uploads';       // Virtual directory in IIS

// Get file from query string
$file = isset($_GET['file']) ? basename($_GET['file']) : null;
$filePath = $file ? $uploadDir . DIRECTORY_SEPARATOR . $file : null;
$imageUrl = $file ? $webPath . '/' . $file : null;

// Check if file exists and is an image
$valid = false;
if ($file && file_exists($filePath)) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $valid = in_array($ext, ['jpg','jpeg','png','gif','webp']);
}

if (!$valid) {
    die("Invalid file.");
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?= htmlspecialchars($file) ?></title>
<style>
img { max-width: 90vw; max-height: 90vh; display: block; margin: 2em auto; border: 1px solid #000; }
body { text-align: center; font-family: sans-serif; }
</style>
</head>
<body>

<h1><?= htmlspecialchars($file) ?></h1>
<img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($file) ?>">

<p><a href="view.php">← Back to list</a></p>

</body>
</html>
