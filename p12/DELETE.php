<?php
if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $filePath = 'uploads/' . $file;

    if (file_exists($filePath)) {
        unlink($filePath);
        echo "File berhasil dihapus.";
    } else {
        echo "File tidak ditemukan.";
    }
} else {
    echo "Nama file tidak valid.";
}
?>
