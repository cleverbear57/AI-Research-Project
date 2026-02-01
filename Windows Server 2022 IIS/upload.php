<?php
/* =====================
FILE: upload.php
===================== */
?>
<?php
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
$maxFileSize = 5 * 1024 * 1024; // 5MB
$allowedTypes = ['image/jpeg','image/png','image/gif','image/webp'];


if (!is_dir($uploadDir)) {
mkdir($uploadDir, 0755, true);
}


$errors = [];
$success = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
$file = $_FILES['image'];


if ($file['error'] !== UPLOAD_ERR_OK) {
$errors[] = 'Upload failed.';
} elseif ($file['size'] > $maxFileSize) {
$errors[] = 'File too large.';
} else {
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);


if (!in_array($mime, $allowedTypes, true)) {
$errors[] = 'Invalid image type.';
} else {
$ext = image_type_to_extension(exif_imagetype($file['tmp_name']), false);
$safeName = bin2hex(random_bytes(8)) . '.' . $ext;
$dest = $uploadDir . DIRECTORY_SEPARATOR . $safeName;


if (move_uploaded_file($file['tmp_name'], $dest)) {
$success = 'Image uploaded.';
} else {
$errors[] = 'Could not save file.';
}
}
}
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Upload</title>
</head>
<body>
<h1>Upload Image</h1>
<p><a href="index.php">← Home</a></p>


<?php foreach ($errors as $e): ?><p style="color:red;"><?= htmlspecialchars($e) ?></p><?php endforeach; ?>
<?php if ($success): ?><p style="color:green;"><?= htmlspecialchars($success) ?></p><?php endif; ?>


<form method="post" enctype="multipart/form-data">
<input type="file" name="image" accept="image/*" required>
<button type="submit">Upload</button>
</form>
</body>
</html>
