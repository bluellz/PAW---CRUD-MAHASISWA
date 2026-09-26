-- Skema database untuk aplikasi CRUD Mahasiswa
-- Import file ini lewat phpMyAdmin atau: mysql -u root -p < database.sql

CREATE DATABASE IF NOT EXISTS db_mahasiswa;
USE db_mahasiswa;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data contoh (opsional, boleh dihapus)
INSERT INTO mahasiswa (nim, nama, jurusan, email) VALUES
('215150200111001', 'Budi Santoso', 'Teknik Informatika', 'budi@student.ub.ac.id'),
('215150200111002', 'Siti Aminah', 'Sistem Informasi', 'siti@student.ub.ac.id'),
('215150200111003', 'Andi Wijaya', 'Teknik Komputer', 'andi@student.ub.ac.id');
