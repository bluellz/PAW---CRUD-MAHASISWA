<?php
require 'config/database.php';

$id = $_GET['id'] ?? $_POST['id'] ?? null;
$error = '';

if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $db->prepare('SELECT * FROM mahasiswa WHERE id = :id');
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nim === '' || $nama === '' || $jurusan === '') {
        $error = 'NIM, nama, dan jurusan wajib diisi.';
    } else {
        $sql = 'UPDATE mahasiswa SET nim = :nim, nama = :nama, jurusan = :jurusan, email = :email WHERE id = :id';
        $stmt = $db->prepare($sql);

        try {
            $stmt->execute([
                ':nim' => $nim,
                ':nama' => $nama,
                ':jurusan' => $jurusan,
                ':email' => $email,
                ':id' => $id,
            ]);

            header('Location: index.php?status=edit_sukses');
            exit;
        } catch (PDOException $e) {
            $error = 'Gagal memperbarui data. Pastikan NIM belum dipakai mahasiswa lain.';
        }
    }

    $data = array_merge($data, compact('nim', 'nama', 'jurusan', 'email'));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Mahasiswa</h1>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form class="form-box" method="POST" action="edit.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8') ?>">

            <label>NIM</label>
            <input type="text" name="nim" value="<?= htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label>Nama</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label>Jurusan</label>
            <input type="text" name="jurusan" value="<?= htmlspecialchars($data['jurusan'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') ?>">

            <br><br>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-back">Batal</a>
        </form>
    </div>
</body>
</html>

