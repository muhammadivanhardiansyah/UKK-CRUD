<?php
// Menghubungkan ke file 'db.php' untuk koneksi database
include 'db.php';

// Query untuk mengambil semua data dari tabel 'students'
$sql = "SELECT * FROM students";

// Eksekusi query dan simpan hasilnya dalam variabel $result
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa</title>
</head>
<body>
    <h1>Daftar Siswa</h1>

    <!-- Tombol untuk menuju halaman tambah data -->
    <a href="create.php">Tambah Data</a>

    <!-- Tabel untuk menampilkan daftar data siswa -->
    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th> <!-- Kolom ID -->
                <th>Nama</th> <!-- Kolom Nama -->
                <th>Umur</th> <!-- Kolom Umur -->
                <th>Kelas</th> <!-- Kolom Kelas -->
                <th>Aksi</th> <!-- Kolom Aksi (Edit dan Hapus) -->
            </tr>
        </thead>
        <tbody>
            <!-- Looping melalui hasil query untuk menampilkan data siswa -->
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td> <!-- Menampilkan ID siswa -->
                    <td><?= $row['name'] ?></td> <!-- Menampilkan Nama siswa -->
                    <td><?= $row['age'] ?></td> <!-- Menampilkan Umur siswa -->
                    <td><?= $row['grade'] ?></td> <!-- Menampilkan Kelas siswa -->
                    <td>
                        <!-- Link untuk mengedit data siswa -->
                        <a href="update.php?id=<?= $row['id'] ?>">Edit</a>

                        <!-- Link untuk menghapus data siswa -->
                        <!-- Menampilkan dialog konfirmasi sebelum penghapusan -->
                        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
