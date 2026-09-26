<?php
require 'config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nim === '' || $nama === '' || $jurusan === '') {
        $error = 'NIM, nama, dan jurusan wajib diisi.';
    } else {
        $sql = 'INSERT INTO mahasiswa (nim, nama, jurusan, email) VALUES (:nim, :nama, :jurusan, :email)';
        $stmt = $db->prepare($sql);

        try {
            $stmt->execute([
                ':nim' => $nim,
                ':nama' => $nama,
                ':jurusan' => $jurusan,
                ':email' => $email,
            ]);

            header('Location: index.php?status=tambah_sukses');
            exit;
        } catch (PDOException $e) {
            $error = 'Gagal menyimpan data. Pastikan NIM belum terdaftar.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Mahasiswa</h1>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form class="form-box" method="POST" action="tambah.php">
            <label>NIM</label>
            <input type="text" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

            <label>Nama</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

            <label>Jurusan</label>
            <input type="text" name="jurusan" value="<?= htmlspecialchars($_POST['jurusan'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <br><br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-back">Batal</a>
        </form>
    </div>
</body>
</html>

