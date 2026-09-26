<?php
require 'config/database.php';

$sql = 'SELECT * FROM mahasiswa ORDER BY id DESC';
$stmt = $db->prepare($sql);
$stmt->execute();
$mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa - CRUD PHP PDO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <h1>Data Mahasiswa</h1>
            <a href="tambah.php" class="btn btn-primary">+ Tambah Mahasiswa</a>
        </div>

        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] === 'tambah_sukses'): ?>
                <div class="alert alert-success">Data mahasiswa berhasil ditambahkan.</div>
            <?php elseif ($_GET['status'] === 'edit_sukses'): ?>
                <div class="alert alert-success">Data mahasiswa berhasil diperbarui.</div>
            <?php elseif ($_GET['status'] === 'hapus_sukses'): ?>
                <div class="alert alert-success">Data mahasiswa berhasil dihapus.</div>
            <?php endif; ?>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($mahasiswa) === 0): ?>
                    <tr>
                        <td colspan="6">Belum ada data mahasiswa.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($mahasiswa as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($row['nim'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['jurusan'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="actions">
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

