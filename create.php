<?php
// Menghubungkan ke file 'db.php' untuk koneksi database
include 'db.php';

// Proses Tambah Data (CREATE)
if (isset($_POST['add'])) { // Jika tombol 'Tambah' diklik
    $name = $_POST['name']; // Ambil nilai input 'name'
    $age = $_POST['age']; // Ambil nilai input 'age'
    $grade = $_POST['grade']; // Ambil nilai input 'grade'

    // Query SQL untuk menambahkan data ke tabel 'students'
    $sql = "INSERT INTO students (name, age, grade) VALUES ('$name', $age, '$grade')";

    // Eksekusi query dan cek apakah berhasil
    if ($conn->query($sql)) {
        // Jika berhasil, arahkan kembali ke halaman 'read.php' dengan status 'success'
        header("Location: read.php?status=success");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data Siswa</h1>

    <!-- Form untuk menambah data -->
    <form method="POST"> <!-- Menggunakan method POST untuk mengirim data -->
        <input type="text" name="name" placeholder="Nama" required> <!-- Input untuk nama -->
        <input type="number" name="age" placeholder="Umur" required> <!-- Input untuk umur -->
        <input type="text" name="grade" placeholder="Kelas" required> <!-- Input untuk kelas -->
        <button type="submit" name="add">Tambah</button> <!-- Tombol untuk submit form -->
    </form>

    <!-- Link untuk kembali ke halaman daftar data (read.php) -->
    <a href="read.php">Kembali ke Daftar</a>
</body>
</html>
