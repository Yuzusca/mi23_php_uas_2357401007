# Admin Panel Management System

## Deskripsi
Aplikasi web sederhana untuk manajemen produk, kategori, dan user admin. Dibuat menggunakan PHP dan MySQL dengan tampilan modern menggunakan Tailwind CSS.

## Fitur
- Login admin
- Dashboard statistik
- Manajemen produk (tambah, edit, hapus, upload gambar)
- Manajemen kategori (tambah, hapus)
- Manajemen user admin (tambah, edit, hapus)
- Sidebar navigasi responsif

## Struktur Folder
```
├── dashboard.php
├── database.sql
├── edit_produk.php
├── edit_user.php
├── hapus_kategori.php
├── hapus_produk.php
├── hapus_user.php
├── index.php
├── kategori.php
├── koneksi.php
├── logout.php
├── produk.php
├── sidebar.php
├── tambah_kategori.php
├── tambah_produk.php
├── tambah_user.php
├── user.php
├── uploads/
```

## Cara Instalasi & Menjalankan
1. **Clone repo ini**
   ```
   git clone <url-repo>
   cd <nama-folder>
   ```
2. **Import database**
   - Buka phpMyAdmin.
   - Buat database baru: `uas_php`.
   - Import file `database.sql` ke database tersebut.

3. **Konfigurasi koneksi**
   - Pastikan file `koneksi.php` sudah sesuai dengan konfigurasi MySQL lokal Anda.

4. **Jalankan aplikasi**
   - Pastikan XAMPP/WAMP/LAMP sudah berjalan.
   - Buka browser dan akses: `http://localhost/<nama-folder>/index.php`

## Akun Demo
- Username: `admin`
- Password: `admin123`

## Catatan
- Folder `uploads/` digunakan untuk menyimpan gambar produk.
- Jika ingin menambah user admin, gunakan menu "Kelola User".
- Untuk menambah kategori atau produk, gunakan menu "Kategori" dan "Manajemen Produk".

## Lisensi
Proyek ini bebas digunakan untuk keperluan pembelajaran.

---

**Penulis:** Yusuf Hidayat (MI23)
