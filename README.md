
# 📚 Aplikasi Perpustakaan

Aplikasi Perpustakaan merupakan aplikasi berbasis web yang dikembangkan menggunakan Laravel 11. Aplikasi ini bertujuan untuk membantu pengelolaan data buku, kategori buku, serta transaksi peminjaman dan pengembalian buku secara terkomputerisasi.

Aplikasi ini memiliki antarmuka yang sederhana, modern, dan responsif sehingga memudahkan pengguna dalam mengelola informasi perpustakaan.

## ✨ Fitur Aplikasi

### 1. Dashboard
- Menampilkan ringkasan informasi perpustakaan.
- Menampilkan statistik data buku.
- Menampilkan informasi kategori dan transaksi peminjaman.

### 2. Manajemen Buku
- Menampilkan seluruh data buku.
- Menambahkan data buku.
- Melihat detail buku.
- Mengedit informasi buku.
- Menghapus data buku.
- Mencari buku berdasarkan judul, penulis, atau ISBN.
- Mengelola stok buku.

### 3. Manajemen Kategori
- Menampilkan seluruh kategori buku.
- Menambahkan kategori baru.
- Melihat detail kategori.
- Melihat daftar buku berdasarkan kategori.
- Mengedit nama dan deskripsi kategori.
- Menghapus kategori.
- Mencari kategori buku.

### 4. Manajemen Peminjaman
- Menambahkan transaksi peminjaman buku.
- Menampilkan data peminjaman.
- Melihat detail transaksi peminjaman.
- Mencari transaksi berdasarkan nama peminjam atau judul buku.
- Memproses pengembalian buku.
- Mencatat tanggal peminjaman.
- Mencatat batas pengembalian.
- Mencatat tanggal aktual pengembalian.
- Mengelola status peminjaman.
- Menghapus riwayat peminjaman yang telah selesai.

### 5. Autentikasi
- Login pengguna.
- Registrasi pengguna.
- Logout pengguna.
- Pengelolaan profil pengguna.

### 6. Antarmuka Pengguna
- Desain responsif.
- Sidebar navigasi.
- Tampilan tabel data.
- Form tambah dan edit data.
- Notifikasi keberhasilan dan kesalahan.
- Konfirmasi penghapusan dan pengembalian menggunakan SweetAlert2.

## 🛠️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|---|---|
| PHP | Bahasa pemrograman backend |
| Laravel 11 | Framework aplikasi |
| MySQL / MariaDB | Database |
| Laravel Breeze | Sistem autentikasi |
| Blade | Template engine |
| Tailwind CSS | Framework CSS |
| JavaScript | Interaksi antarmuka |
| SweetAlert2 | Notifikasi dan konfirmasi |
| Vite | Frontend build tool |
| XAMPP | Server lokal |

## 📋 Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan perangkat sudah memiliki:

- PHP sesuai persyaratan Laravel 11.
- Composer.
- Node.js dan npm.
- MySQL atau MariaDB.
- XAMPP.
- Web browser.

## 🚀 Instalasi dan Konfigurasi

### 1. Clone Repository

```bash
git clone <URL-REPOSITORY>
```

Masuk ke direktori proyek:

```bash
cd perpustakaan-app
```

### 2. Install Dependency Laravel

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Windows CMD:

```bash
copy .env.example .env
```

PowerShell:

```powershell
Copy-Item .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Buat Database

1. Jalankan Apache dan MySQL melalui XAMPP.
2. Buka phpMyAdmin.
3. Buat database dengan nama `db_perpus`.

### 6. Konfigurasi Database

Buka file `.env`, kemudian sesuaikan konfigurasi berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_library
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username, password, dan port dengan konfigurasi database lokal.

### 7. Jalankan Migration

```bash
php artisan migrate
```

Jika proyek menyediakan seeder dan data awal diperlukan:

```bash
php artisan db:seed
```

**Catatan:** Jangan menggunakan `php artisan migrate:fresh` pada database yang berisi data penting karena perintah tersebut akan menghapus seluruh tabel.

### 8. Install Dependency Frontend

```bash
npm install
```

Jalankan Vite:

```bash
npm run dev
```

Untuk kebutuhan produksi:

```bash
npm run build
```

### 9. Jalankan Aplikasi

Buka terminal baru dan jalankan:

```bash
php artisan serve
```

Buka browser dan akses:

```text
http://127.0.0.1:8000
```

## 📁 Struktur Direktori

```text
perpustakaan-app/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   └── Traits/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   └── views/
│       ├── books/
│       ├── categories/
│       ├── loans/
│       ├── layouts/
│       └── components/
│
├── routes/
│   ├── web.php
│   └── auth.php
│
├── public/
├── storage/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

## 📌 Perintah Laravel yang Berguna

Melihat daftar route:

```bash
php artisan route:list
```

Memeriksa status migration:

```bash
php artisan migrate:status
```

Membersihkan cache aplikasi:

```bash
php artisan optimize:clear
```

Menjalankan server Laravel:

```bash
php artisan serve
```

## 🔐 Keamanan

- Jangan mengunggah file `.env` ke repository publik.
- Jangan membagikan password database.
- Gunakan validasi pada setiap input pengguna.
- Pastikan autentikasi diterapkan pada halaman yang membutuhkan akses pengguna.

## 👨‍💻 Pengembang

**Nama:** [Nama Pengembang]

**Program Studi:** Teknik Informatika

**Framework:** Laravel 11

**Proyek:** Aplikasi Perpustakaan Berbasis Web

---

Dikembangkan sebagai proyek pembelajaran dan pengembangan aplikasi web menggunakan Laravel 11.
