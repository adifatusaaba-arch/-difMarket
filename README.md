# @difMarket — Marketplace Produk UMKM Modern

**@difMarket** adalah platform website marketplace UMKM modern berbasis **Laravel**, **PHP 8.3**, **MySQL**, dan **Tailwind CSS** yang dirancang untuk memasarkan berbagai produk unggulan pelaku Usaha Mikro, Kecil, dan Menengah (UMKM) Indonesia secara online, bersih, responsif, dan profesional.

## Fitur Utama

### Halaman Publik
- **Beranda**: Navbar interaktif dengan logo `@difMarket`, hero section, kategori produk UMKM, produk unggulan, produk terbaru, keunggulan berbelanja, dan footer informasi usaha.
- **Katalog Produk (`/produk`)**: Daftar produk dari database MySQL dilengkapi pencarian kata kunci, filter kategori, pengurutan (terbaru, termurah, termahal, nama A-Z), dan paginasi.
- **Detail Produk (`/produk/{slug}`)**: Foto produk besar, harga Rupiah, ketersediaan stok, deskripsi lengkap, tombol langsung **Hubungi Penjual via WhatsApp** dengan pesan otomatis, serta produk terkait.
- **Halaman Kategori (`/kategori` & `/kategori/{slug}`)**: Daftar kategori lengkap dengan ikon dan jumlah produk.
- **Tentang Kami (`/tentang-kami`)**: Profil `@difMarket`, visi, misi, tujuan, serta manfaat marketplace bagi UMKM.
- **Kontak (`/kontak`)**: Informasi email, WhatsApp, alamat usaha, jam operasional, dan formulir pesan dengan validasi server-side Bahasa Indonesia.

### Dashboard Admin (`/admin`)
- **Autentikasi Admin**: Login, proteksi middleware (`auth` & `admin`), password hashing, CSRF protection, dan logout.
- **Dashboard Statistik**: Total produk, total kategori, total stok unit, produk stok menipis, pesan masuk terbaru, serta daftar produk terbaru.
- **CRUD Produk Lengkap**: Tambah, lihat, edit, dan hapus produk beserta **upload gambar** (`JPG, JPEG, PNG, WEBP`, maks 2 MB) ke `storage/app/public/products` dengan penghapusan otomatis gambar lama saat diubah atau dihapus.
- **CRUD Kategori Lengkap**: Tambah, edit, dan hapus kategori produk.

## Teknologi yang Digunakan
- **Backend**: PHP 8.3, Laravel 13 (MVC + Eloquent ORM)
- **Database**: MySQL
- **Frontend**: Blade Templates, Tailwind CSS v4, Vite, JavaScript
- **Dependency & Version Control**: Composer, NPM, Git & GitHub

## Cara Instalasi Project

1. **Clone repository**
   ```bash
   git clone https://github.com/<username-anda>/difMarket.git
   cd difMarket
   ```

2. **Install dependensi PHP & JavaScript**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Salin file konfigurasi `.env` dan buat App Key**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database MySQL di `.env`**
   Buat database bernama `difmarket` di MySQL, lalu sesuaikan `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=difmarket
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migrasi, Seeder, dan Storage Link**
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

6. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Akses website publik di `http://127.0.0.1:8000` dan login admin di `http://127.0.0.1:8000/admin/login`.

## Akun Admin Default (Hasil Seeder)
- **Email**: `admin@difmarket.id`
- **Password**: `password123`

> **Catatan Keamanan**: Jangan pernah mengunggah file `.env` atau kredensial database produksi ke repository GitHub.

## Panduan Menghubungkan ke Repository GitHub (`difMarket`)

1. Buat repository baru bernama **`difMarket`** di akun GitHub Anda (tanpa README/gitignore tambahan agar tidak konflik).
2. Hubungkan repository lokal dengan GitHub dan push branch `main`:
   ```bash
   git remote add origin https://github.com/<username-anda>/difMarket.git
   git branch -M main
   git push -u origin main
   ```
