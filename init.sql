-- ==========================================================
-- ELKPOS DATABASE INITIALIZATION SCRIPT
-- ==========================================================

-- 1. Tabel Users (Manajemen Pengguna & Hak Akses)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Disimpan sebagai hash di produksi
    nama_lengkap VARCHAR(100) NOT NULL,
    role ENUM('admin', 'kasir', 'owner') NOT NULL
);

-- 2. Tabel Kategori (Pengelompokan Barang Elektronik)
CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL
);

-- 3. Tabel Produk (Manajemen Stok & Harga Jual)
CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori_id INT,
    barcode VARCHAR(50) UNIQUE,
    nama_produk VARCHAR(100) NOT NULL,
    harga_jual INT NOT NULL,
    stok INT NOT NULL,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE SET NULL
);

-- 4. Tabel Transaksi (Header Nota Penjualan)
CREATE TABLE IF NOT EXISTS transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_nota VARCHAR(50) NOT NULL UNIQUE,
    user_id INT,
    tanggal_waktu DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_akhir INT NOT NULL,
    metode_pembayaran ENUM('tunai', 'qris', 'transfer') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- 5. Tabel Detail Transaksi (Isi Barang & Pelacakan Garansi Elektronik)
CREATE TABLE IF NOT EXISTS detail_transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT,
    produk_id INT,
    jumlah INT NOT NULL,
    harga_satuan INT NOT NULL,
    serial_number VARCHAR(100), -- Penting untuk identitas unik barang elektronik
    garansi_sampai DATE,        -- Pelacakan masa berlaku garansi pelanggan
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (produk_id) REFERENCES produk(id) ON DELETE SET NULL
);

-- ==========================================================
-- DATA AWAL UNTUK TESTING (DML)
-- ==========================================================

-- Memasukkan Akun Pengguna (Password contoh: 'rootdb')
INSERT INTO users (username, password, nama_lengkap, role) VALUES 
('admin', 'admin', 'Andi', 'admin'),
('kasir', 'kasir123', 'Budi Kasir', 'kasir'),
('owner', 'own123', 'Sultan Owner', 'owner');

-- Memasukkan Kategori Barang
INSERT INTO kategori (nama_kategori) VALUES 
('Laptop'), 
('Smartphone'), 
('Aksesoris');

-- Memasukkan Produk Elektronik Awal
INSERT INTO produk (kategori_id, barcode, nama_produk, harga_jual, stok) VALUES 
(1, 'LAP-ASUS-001', 'ASUS Vivobook 14', 7500000, 10),
(2, 'HP-SAMSUNG-023', 'Samsung Galaxy S23', 12000000, 5),
(3, 'ACC-MSE-99', 'Mouse Logitech Wireless', 250000, 20);

-- Contoh Transaksi yang Berhasil
INSERT INTO transaksi (nomor_nota, user_id, total_akhir, metode_pembayaran) VALUES 
('INV-20260718-001', 2, 7500000, 'tunai');