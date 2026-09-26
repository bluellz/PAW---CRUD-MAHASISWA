<?php
require 'config/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = 'DELETE FROM mahasiswa WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
}

header('Location: index.php?status=hapus_sukses');
exit;

