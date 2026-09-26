<?php
$host = '127.0.0.1';
$port = '3306';
$dbname = 'db_mahasiswa';
$username = 'root';
$password = 'mamabapak';

try {
    $db = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Koneksi database gagal. Silakan coba lagi nanti.');
}

