# Aplikasi CRUD Rumah Sakit & Pasien (Laravel)

Ini adalah aplikasi web yang dibangun menggunakan **Laravel** untuk memenuhi requirement tes kerja Web Programmer. Aplikasi ini mencakup fungsionalitas **CRUD (Create, Read, Update, Delete)** untuk data Rumah Sakit dan Pasien, lengkap dengan sistem otentikasi.

---

## ✨ Fitur
- 🔑 Otentikasi Pengguna (login & register).
- 🏥 CRUD Rumah Sakit.
- 🧑‍⚕️ CRUD Pasien (relasi ke Rumah Sakit).
- 🗑️ Hapus via AJAX (tanpa reload halaman).
- 🔍 Filter Pasien via AJAX.
- 🛠️ Database Migration & Seeder.

---

## 📦 Prasyarat
- PHP >= 8.1
- Composer
- Node.js & NPM
- Database MySQL
- Server lokal: Laragon / XAMPP

---

## 🚀 Cara Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/USERNAME/laravel_rumahsakit_app.git
cd laravel_rumahsakit_app/rumahsakit_app

composer install
npm install

cp .env.example .env

php artisan key:generate

DB_DATABASE=laravel_testdb
DB_USERNAME=root
DB_PASSWORD=

php artisan migrate:fresh --seed

npm run dev
php artisan serve
Akses di http://127.0.0.1:8000

---

🔑 Kredensial Login

Username: admin

Password: password

### 4. Tambahkan README ke Repository
Simpan file di root folder proyek dengan nama `README.md`.  
Lalu commit & push lagi:

```bash
git add README.md
git commit -m "Add project documentation"
git push
