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

// Get selected file from query string
$selected = isset($_GET['file']) ? basename($_GET['file']) : null;
$selectedPath = $selected ? $uploadDir . DIRECTORY_SEPARATOR . $selected : null;
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
    <li><a href="?file=<?= urlencode($file) ?>"><?= htmlspecialchars($file) ?></a></li>
<?php endforeach; ?>
</ul>

<?php if ($selected && file_exists($selectedPath)): ?>
<h2>Selected File: <?= htmlspecialchars($selected) ?></h2>
<p><a href="<?= htmlspecialchars($selectedPath) ?>" target="_blank">Download / View</a></p>
<?php endif; ?>

</body>
</html>
