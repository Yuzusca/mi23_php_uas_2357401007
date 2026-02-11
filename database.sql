
-- * NIM   : 2357401007
-- * Nama  : Yusuf Hidayat 
-- * Kelas : MI23 


-- Tambahkan kolom kode_produk pada tabel produk jika belum ada
ALTER TABLE produk ADD COLUMN kode_produk VARCHAR(50) AFTER id;
-- Struktur Database UAS PHP
CREATE DATABASE IF NOT EXISTS uas_php;
USE uas_php;

-- Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Tabel Kategori
CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_produk VARCHAR(50),
    nama_produk VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    id_kategori INT NOT NULL,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id) ON DELETE CASCADE
);
-- Tambahkan kolom deskripsi dan gambar pada tabel produk jika belum ada
ALTER TABLE produk ADD COLUMN deskripsi TEXT AFTER nama_produk;
ALTER TABLE produk ADD COLUMN gambar VARCHAR(255) AFTER deskripsi;

-- User Admin Default
INSERT INTO users (username, password) VALUES ('admin', MD5('admin123'));

-- Contoh Kategori
INSERT INTO kategori (nama_kategori) VALUES ('Mobile Legend'), ('Roblox'), ('Free Fire');

-- Contoh Produk
INSERT INTO produk (kode_produk, nama_produk, deskripsi, gambar, harga, stok, id_kategori) VALUES
('P0001', 'Weekly Diamond Pass Region Indonesia', 'khusus region indonesia', '', 26500, 10, 1),
('P0002', '350 Diamond Free Fire', '350 diamond free fire', '', 50000, 50, 2),
('P0003', '100 Robux via Login', 'format dikirim ke whatsapp admin', '', 15000, 100, 3);
