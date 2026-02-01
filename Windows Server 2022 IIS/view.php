<?php
/* =====================
FILE: view.php
===================== */
?>
<?php
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
$images = [];


if (is_dir($uploadDir)) {
foreach (new DirectoryIterator($uploadDir) as $item) {
if ($item->isFile()) {
$images[] = $item->getFilename();
}
}
}


// If ?img= is provided, show that image
$selected = isset($_GET['img']) ? basename($_GET['img']) : null;
$selectedPath = $selected ? 'uploads/' . $selected : null;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>View Images</title>
<style>
.thumbs a{margin-right:12px}
img{max-width:600px;display:block;margin-top:16px}
</style>
</head>
<body>
<h1>View Images</h1>
<p><a href="index.php">← Home</a></p>


<div class="thumbs">
<?php foreach ($images as $img): ?>
<a href="view.php?img=<?= urlencode($img) ?>"><?= htmlspecialchars($img) ?></a>
<?php endforeach; ?>
</div>


<?php if ($selected && file_exists(__DIR__ . '/' . $selectedPath)): ?>
<h2>Selected</h2>
<img src="<?= htmlspecialchars($selectedPath) ?>" alt="">
<?php endif; ?>
</body>
</html>
