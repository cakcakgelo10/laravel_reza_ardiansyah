Aplikasi CRUD Rumah Sakit & Pasien (Laravel)
Ini adalah aplikasi web yang dibangun menggunakan Laravel untuk memenuhi requirement tes kerja Web Programmer. Aplikasi ini mencakup fungsionalitas CRUD (Create, Read, Update, Delete) untuk data Rumah Sakit dan Pasien, lengkap dengan sistem otentikasi.

Fitur
Otentikasi Pengguna: Halaman login dan register yang aman. Login menggunakan username dan password.

CRUD Rumah Sakit: Manajemen data rumah sakit (Tambah, Lihat, Edit, Hapus).

CRUD Pasien: Manajemen data pasien dengan relasi ke tabel rumah sakit.

Hapus via AJAX: Tombol hapus pada kedua modul tidak me-refresh halaman, memberikan pengalaman pengguna yang lebih mulus.

Filter Pasien via AJAX: Daftar pasien dapat difilter secara dinamis berdasarkan rumah sakit tanpa perlu me-reload halaman.

Database Migration & Seeder: Skrip untuk membuat struktur database dan mengisi data awal secara otomatis.

Prasyarat
PHP >= 8.1

Composer

Node.js & NPM

Database MySQL

Lingkungan server lokal seperti Laragon atau XAMPP.

Cara Instalasi dan Menjalankan Proyek
Clone Repository

git clone https://github.com/cakcakgelo10/laravel_reza_ardiansyah.git
cd laravel_reza_ardiansyah/rumahsakit_app

Install Dependensi
Jalankan perintah ini untuk menginstall semua library yang dibutuhkan.

composer install
npm install

Setup Environment File
Salin file .env.example menjadi .env.

copy .env.example .env

Generate Application Key

php artisan key:generate

Konfigurasi Database

Buka file .env dan sesuaikan pengaturan database (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

Pastikan kamu sudah membuat database kosong dengan nama yang sesuai (misal: laravel_testdb).

Jalankan Migrasi dan Seeder
Perintah ini akan membuat semua tabel dan mengisinya dengan data awal (termasuk user admin).

php artisan migrate:fresh --seed

Compile Aset Frontend
Jalankan "mesin pemasak" Vite. Biarkan terminal ini tetap berjalan.

npm run dev

Jalankan Server Aplikasi
Buka terminal baru, masuk ke folder proyek, dan jalankan server.

php artisan serve

Akses Aplikasi

Buka browser dan kunjungi http://127.0.0.1:8000.

Klik "Log in" dan masuk dengan kredensial di bawah ini.

Kredensial Login
Username: admin

Password: password