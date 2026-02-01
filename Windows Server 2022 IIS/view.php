<?php
/* =====================
FILE: view.php
===================== */
?>

<?php
// Absolute path to uploads folder
$uploadDir = 'C:\uploads'; 

$files = [];

// Scan uploads folder
if (is_dir($uploadDir)) {
    foreach (new DirectoryIterator($uploadDir) as $item) {
        if ($item->isFile()) {
            $files[] = $item->getFilename();
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Uploaded Files</title>
<style>
ul { list-style-type: none; padding-left: 0; }
li { margin-bottom: 6px; }
</style>
</head>
<body>
<h1>Uploaded Files</h1>
<p><a href="index.php">← Home</a></p>

<ul>
<?php foreach ($files as $file): ?>
    <li><a href="show.php?file=<?= urlencode($file) ?>"><?= htmlspecialchars($file) ?></a></li>
<?php endforeach; ?>
</ul>

</body>
</html>
