<?php
/* =====================
FILE: view.php
===================== */
?>

<?php
// Absolute path to uploads folder
$uploadDir = 'C:\uploads';  // Update this to match your PowerShell setup
$webPath = '/uploads';       // This must map to a virtual directory in IIS for browser access

$images = [];

// Scan uploads folder
if (is_dir($uploadDir)) {
    foreach (new DirectoryIterator($uploadDir) as $item) {
        if ($item->isFile() && preg_match('/\.(jpe?g|png|gif|webp)$/i', $item->getFilename())) {
            $images[] = $item->getFilename();
        }
    }
}

// Get selected image from query string
$selected = isset($_GET['img']) ? basename($_GET['img']) : null;
$selectedPath = $selected ? $webPath . '/' . $selected : null;
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>View Images</title>
<style>
.thumbs a { margin-right:12px; display:inline-block; margin-bottom:12px; text-decoration:none; }
.thumbs img { max-width:150px; max-height:150px; border:1px solid #ccc; padding:2px; display:block; }
img.full { max-width:600px; display:block; margin-top:16px; border:1px solid #000; }
</style>
</head>
<body>
<h1>View Images</h1>
<p><a href="index.php">← Home</a></p>

<div class="thumbs">
<?php foreach ($images as $img): ?>
<a href="view.php?img=<?= urlencode($img) ?>">
    <img src="<?= htmlspecialchars($webPath . '/' . $img) ?>" alt="<?= htmlspecialchars($img) ?>">
    <span><?= htmlspecialchars($img) ?></span>
</a>
<?php endforeach; ?>
</div>

<?php if ($selected && file_exists($uploadDir . DIRECTORY_SEPARATOR . $selected)): ?>
<h2>Selected Image</h2>
<img src="<?= htmlspecialchars($selectedPath) ?>" class="full" alt="">
<?php endif; ?>

</body>
</html>
