# 🕌 Sistem Informasi Musholla Al-Kautsar (Web-Musholla)

Sistem Informasi dan Platform Donasi Berbasis Web Premium untuk Musholla Al-Kautsar. Didesain dengan antarmuka yang sangat modern, mengedepankan estetika **Liquid Glassmorphism**, serta responsivitas tinggi untuk pengalaman pengguna (jamaah & donatur) yang maksimal di setiap perangkat.

---

## ✨ Fitur Utama

- **Modern & Premium UI:** Animasi halus, layout *Mobile-First*, dan integrasi **SVG Liquid Glass Displacement Filter** untuk memberikan efek visual kelas atas yang jauh dari kesan kaku.
- **Portal Donasi Terintegrasi:** Memudahkan donatur untuk menyumbang dengan instruksi yang jelas dan transparan.
- **Galeri Storytelling (Separated Cards):** Fitur galeri foto masjid yang imersif. Menampilkan foto dengan resolusi tinggi yang disandingkan dengan deskripsi *glassmorphic layer*.
- **Portal Artikel/Berita:** Sistem manajemen artikel untuk mempublikasikan kajian, jadwal, atau laporan progres pembangunan.
- **Admin Dashboard:** Dasbor yang tangguh dan estetik untuk mengelola donasi, artikel, pengguna, serta *monitoring* lalu lintas web.

## 🛠️ Tech Stack

Platform ini dibangun menggunakan teknologi terbaru untuk skalabilitas dan performa:

- **Framework Core:** [Laravel 11.x](https://laravel.com)
- **Styling:** [Tailwind CSS 3.x](https://tailwindcss.com) (Utility-first framework)
- **Frontend Interactivity:** [Alpine.js](https://alpinejs.dev)
- **Visual Effects:** Vanilla JavaScript + Native SVG Filters
- **Database:** MySQL / SQLite

## 🚀 Panduan Instalasi (Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di *local environment* (seperti Laragon/XAMPP):

### 1. Clone Repositori
```bash
git clone https://github.com/Aristyo2006/Web-Musholla.git
cd Web-Musholla
```

### 2. Instalasi Dependensi PHP & Node.js
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
Salin file konfigurasi *environment* bawaan Laravel:
```bash
cp .env.example .env
```
Lalu buka file `.env` yang baru dibuat dan sesuaikan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=donasi_musholla_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key & Migrasi Database
```bash
php artisan key:generate
php artisan migrate --seed
```
*(Tambahkan argumen `--seed` jika Anda memiliki data dummy bawaan untuk artikel/donasi)*

### 5. Link Storage (Untuk Media & Galeri)
Jalankan perintah ini agar aset foto yang diunggah dapat diakses oleh publik:
```bash
php artisan storage:link
```

### 6. Jalankan Local Development Server
Untuk menjalankan backend (Laravel) dan merender aset *frontend* (Vite) secara bersamaan, buka **dua** terminal dan jalankan:

Terminal 1:
```bash
php artisan serve
```
Terminal 2:
```bash
npm run dev
```

Aplikasi sekarang dapat diakses melalui browser di alamat: `http://127.0.0.1:8000`

---

*Didukung dan dikembangkan secara eksklusif untuk **Musholla Al-Kautsar**.*
