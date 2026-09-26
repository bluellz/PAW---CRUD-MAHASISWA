# CRUD Data Mahasiswa — PHP & PDO

Aplikasi web sederhana untuk **menampilkan (Read), menambah (Create), mengubah (Update), dan menghapus (Delete)** data mahasiswa dalam satu tabel database MySQL, dibangun dengan PHP native dan PDO (PHP Data Objects) sesuai materi kuliah *Pengembangan Aplikasi Web*.

Dibuat sebagai tugas mata kuliah **Pengembangan Aplikasi Web** — FILKOM, Universitas Brawijaya.

## Fitur

- **Read** — menampilkan seluruh data mahasiswa dalam bentuk tabel
- **Create** — form tambah data mahasiswa baru
- **Update** — form edit data mahasiswa yang sudah ada
- **Delete** — hapus data mahasiswa dengan konfirmasi

Semua query database menggunakan **prepared statement** (parameter bernama) untuk mencegah SQL Injection.

## Teknologi

- PHP (native, tanpa framework)
- MySQL
- PDO (PHP Data Objects)
- HTML & CSS

## Struktur Folder

```
crud-mahasiswa/
├── config/
│   └── database.php   # koneksi database (PDO)
├── index.php          # halaman utama (Read)
├── tambah.php         # form tambah data (Create)
├── edit.php           # form edit data (Update)
├── hapus.php          # proses hapus data (Delete)
├── style.css           # styling halaman
└── database.sql       # skema tabel + data contoh
```

## Cara Menjalankan

1. Clone repository ini:
   ```bash
   git clone <url-repo-ini>
   cd crud-mahasiswa
   ```
2. Buat database dengan mengimpor `database.sql` (lewat phpMyAdmin, atau CLI):
   ```bash
   mysql -u root -p < database.sql
   ```
3. Sesuaikan kredensial database di `config/database.php` (`$host`, `$dbname`, `$username`, `$password`) jika perlu.
4. Jalankan dengan PHP built-in server:
   ```bash
   php -S localhost:8000
   ```
5. Buka `http://localhost:8000` di browser.

## Skema Tabel `mahasiswa`

| Kolom      | Tipe          | Keterangan          |
|------------|---------------|---------------------|
| id         | INT           | Primary key, auto increment |
| nim        | VARCHAR(20)   | Unik                 |
| nama       | VARCHAR(100)  |                      |
| jurusan    | VARCHAR(100)  |                      |
| email      | VARCHAR(100)  | Opsional             |
| created_at | TIMESTAMP     | Otomatis saat insert |
