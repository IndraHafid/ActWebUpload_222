<?php
$uploadDir = 'uploads/';
$files = array_diff(scandir($uploadDir), ['.', '..']);
$allowedImageTypes = ['jpg', 'jpeg', 'png', 'gif'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Daftar File</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .file-box {
      background: #fff;
      border-radius: 10px;
      padding: 15px 200px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .file-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .file-thumb {
      width: 48px;
      height: 48px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #ddd;
    }
    a {
      word-break: break-word;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h4><span class="me-2">📁</span>Daftar File yang Telah Diupload</h4>
    <hr>

    <?php if (empty($files)) : ?>
      <p class="text-muted">Belum ada file yang diunggah.</p>
    <?php else : ?>
      <?php foreach ($files as $file) :
        $filePath = $uploadDir . $file;
        $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $isImage = in_array($fileExt, $allowedImageTypes);
      ?>
        <div class="file-box">
          <div class="file-info">
            <?php if ($isImage): ?>
              <img src="<?= $filePath ?>" alt="thumb" class="file-thumb">
            <?php else: ?>
              <img src="icons/file-icon.png" alt="file" class="file-thumb" onerror="this.style.display='none'">
            <?php endif; ?>
            <a href="<?= $filePath ?>" target="_blank"><?= htmlspecialchars($file) ?></a>
          </div>
          <div>
            <a href="<?= $filePath ?>" class="btn btn-success btn-sm" download>⬇️ Unduh</a>
            <a href="DELETE.php?file=<?= urlencode($file) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus file ini?')">🗑️ Hapus</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</body>
</html>
