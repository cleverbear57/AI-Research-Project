<?php
$uploadDir = 'C:\uploads';
$webPath = '/uploads';
$files = [];

if (is_dir($uploadDir)) {
    foreach (new DirectoryIterator($uploadDir) as $item) {
        if ($item->isFile()) {
            $files[] = $item->getFilename();
        }
    }
}
?>
<html>
<body>
<h1>Uploaded Files</h1>
<ul>
<?php foreach ($files as $file): ?>
    <li><a href="<?= $webPath . '/' . urlencode($file) ?>" target="_blank"><?= htmlspecialchars($file) ?></a></li>
<?php endforeach; ?>
</ul>
</body>
</html>
