<?php
// Informasi koneksi ke database
$host = 'localhost'; // Host database
$user = 'root'; // Username MySQL (default: root)
$password = ''; // Password MySQL (kosong untuk default)
$dbname = 'school'; // Nama database yang akan digunakan

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error); // Jika gagal, tampilkan pesan error
}

// Tambah Data (CREATE)
if (isset($_POST['add'])) { // Jika tombol "Tambah" diklik
    $name = $_POST['name']; // Ambil nilai input "name"
    $age = $_POST['age']; // Ambil nilai input "age"
    $grade = $_POST['grade']; // Ambil nilai input "grade"

    // Query SQL untuk menambahkan data ke tabel "students"
    $sql = "INSERT INTO students (name, age, grade) VALUES ('$name', $age, '$grade')";
    $conn->query($sql); // Eksekusi query
}

// Update Data (UPDATE)
if (isset($_POST['update'])) { // Jika tombol "Update" diklik
    $id = $_POST['id']; // Ambil nilai input "id"
    $name = $_POST['name']; // Ambil nilai input "name"
    $age = $_POST['age']; // Ambil nilai input "age"
    $grade = $_POST['grade']; // Ambil nilai input "grade"

    // Query SQL untuk mengupdate data di tabel "students"
    $sql = "UPDATE students SET name='$name', age=$age, grade='$grade' WHERE id=$id";
    $conn->query($sql); // Eksekusi query
}

// Hapus Data (DELETE)
if (isset($_GET['delete'])) { // Jika link "Hapus" diklik
    $id = $_GET['delete']; // Ambil nilai parameter "delete" dari URL

    // Query SQL untuk menghapus data dari tabel "students"
    $sql = "DELETE FROM students WHERE id=$id";
    $conn->query($sql); // Eksekusi query
}

// Ambil Data (READ)
$sql = "SELECT * FROM students"; // Query SQL untuk mengambil semua data dari tabel "students"
$result = $conn->query($sql); // Eksekusi query dan simpan hasilnya ke $result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
</head>
<body>
    <h1>CRUD Sederhana</h1>

    <!-- Form Tambah Data -->
    <form method="POST"> <!-- Form untuk menambah data -->
        <input type="text" name="name" placeholder="Nama" required> <!-- Input untuk nama -->
        <input type="number" name="age" placeholder="Umur" required> <!-- Input untuk umur -->
        <input type="text" name="grade" placeholder="Kelas" required> <!-- Input untuk kelas -->
        <button type="submit" name="add">Tambah</button> <!-- Tombol untuk submit form -->
    </form>

    <hr>

    <!-- Tabel Data -->
    <table border="1" cellspacing="0" cellpadding="10"> <!-- Membuat tabel untuk menampilkan data -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Looping untuk menampilkan data dari database -->
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td> <!-- Tampilkan ID -->
                    <td><?= $row['name'] ?></td> <!-- Tampilkan Nama -->
                    <td><?= $row['age'] ?></td> <!-- Tampilkan Umur -->
                    <td><?= $row['grade'] ?></td> <!-- Tampilkan Kelas -->
                    <td>
                        <!-- Form Update -->
                        <form method="POST" style="display:inline;"> <!-- Form untuk mengupdate data -->
                            <input type="hidden" name="id" value="<?= $row['id'] ?>"> <!-- Input hidden untuk ID -->
                            <input type="text" name="name" value="<?= $row['name'] ?>" required> <!-- Input untuk nama -->
                            <input type="number" name="age" value="<?= $row['age'] ?>" required> <!-- Input untuk umur -->
                            <input type="text" name="grade" value="<?= $row['grade'] ?>" required> <!-- Input untuk kelas -->
                            <button type="submit" name="update">Update</button> <!-- Tombol untuk submit form update -->
                        </form>

                        <!-- Tombol Hapus -->
                        <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a> <!-- Link untuk menghapus data -->
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php $conn->close(); // Tutup koneksi ke database ?>
