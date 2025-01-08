<?php
// Menghubungkan ke file 'db.php' untuk koneksi database
include 'db.php';

// Mengecek apakah parameter 'id' ada pada URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Mengambil nilai 'id' dari URL

    // Query untuk mendapatkan data siswa berdasarkan 'id'
    $sql = "SELECT * FROM students WHERE id=$id";

    // Eksekusi query dan simpan hasilnya dalam variabel $result
    $result = $conn->query($sql);

    // Ambil data siswa sebagai array asosiatif
    $data = $result->fetch_assoc();
}

// Mengecek apakah form telah di-submit untuk update data
if (isset($_POST['update'])) {
    // Ambil data dari input form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    // Query untuk mengupdate data siswa berdasarkan 'id'
    $sql = "UPDATE students SET name='$name', age=$age, grade='$grade' WHERE id=$id";

    // Eksekusi query
    if ($conn->query($sql)) {
        // Jika berhasil, arahkan ke halaman 'read.php' dengan status 'updated'
        header("Location: read.php?status=updated");
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
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data Siswa</h1>

    <!-- Form untuk mengedit data siswa -->
    <form method="POST">
        <!-- Input hidden untuk menyimpan ID siswa -->
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <!-- Input untuk nama siswa -->
        <input type="text" name="name" value="<?= $data['name'] ?>" required>

        <!-- Input untuk umur siswa -->
        <input type="number" name="age" value="<?= $data['age'] ?>" required>

        <!-- Input untuk kelas siswa -->
        <input type="text" name="grade" value="<?= $data['grade'] ?>" required>

        <!-- Tombol untuk menyimpan perubahan -->
        <button type="submit" name="update">Simpan</button>
    </form>

    <!-- Link kembali ke halaman daftar siswa -->
    <a href="read.php">Kembali ke Daftar</a>
</body>
</html>
