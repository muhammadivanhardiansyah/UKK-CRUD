<?php
// Menghubungkan ke file 'db.php' untuk koneksi ke database
include 'db.php';

// Mengecek apakah parameter 'id' ada pada URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Mengambil nilai 'id' dari URL

    // Query untuk menghapus data siswa berdasarkan 'id'
    $sql = "DELETE FROM students WHERE id=$id";

    // Eksekusi query
    if ($conn->query($sql)) {
        // Jika berhasil, arahkan ke halaman 'read.php' dengan status 'deleted'
        header("Location: read.php?status=deleted");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . $conn->error;
    }
}
?>
