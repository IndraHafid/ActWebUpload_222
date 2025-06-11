<?php
$targetDir = "uploads/"; // Pastikan folder ini ada dan dapat ditulisi
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

// Cek apakah file sudah dikirim
if (!isset($_FILES["fileToUpload"])) {
    echo "File tidak ditemukan di \$_FILES.";
    exit;
}

// Cek error upload
if ($_FILES["fileToUpload"]["error"] !== 0) {
    echo "Terjadi error saat upload. Kode error: " . $_FILES["fileToUpload"]["error"];
    exit;
}

// Cek apakah folder tujuan ada, kalau tidak buat
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// (Optional) Validasi tipe file
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

if (!in_array($fileType, $allowedTypes)) {
    echo "Maaf, hanya file JPG, PNG, GIF, dan PDF yang diizinkan.";
    $uploadOk = 0;
}

// (Optional) Batas ukuran file (misalnya 5MB)
$maxSize = 5 * 1024 * 1024;
if ($_FILES["fileToUpload"]["size"] > $maxSize) {
    echo "Maaf, ukuran file terlalu besar (maks 5MB).";
    $uploadOk = 0;
}

// Upload jika tidak ada masalah
if ($uploadOk) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "File " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " berhasil diunggah.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
} else {
    echo "File tidak diunggah karena ada kesalahan.";
}
?>
