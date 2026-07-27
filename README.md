# 📦 ElkPOS - Enterprise Point of Sales System

ElkPOS adalah aplikasi **Enterprise Point of Sales (POS)** modern yang dirancang khusus untuk toko elektronik. Aplikasi ini dibangun menggunakan arsitektur **Single Page Application (SPA)** menggunakan **JavaScript Vanilla** pada sisi frontend dan **PHP Native** pada sisi backend.

Tujuan utama proyek ini adalah membangun sistem kasir yang ringan, cepat, aman, mudah dipelihara, serta menerapkan standar pengembangan perangkat lunak (Software Engineering) yang baik.

---

# 🚀 Fitur Utama

- Single Page Application (SPA)
- Dashboard Interaktif
- Manajemen Produk
- Manajemen Stok
- Sistem Kasir
- Laporan Penjualan
- Login Multi User
- Central API Routing
- Docker Environment
- Responsive Design

---

# 🛠 Tech Stack

## Frontend

- HTML5
- CSS3
- JavaScript Vanilla
- Bootstrap 5
- Fetch API

## Backend

- PHP Native
- Object Oriented Programming (OOP)
- Controller Pattern

## Database

- MySQL 8.0

## Web Server

- Nginx
- PHP-FPM

## Containerization

- Docker
- Docker Compose

---

# 📂 Struktur Proyek

```text
pos/
├── docker-compose.yml
├── nginx.conf
├── README.md
├── init.sql
│
├── public/
│   ├── index.html
│   │
│   ├── auth/
│   │   └── login.html
│   │
│   ├── assets/
│   │   ├── css/
│   │   │   ├── auth.css
│   │   │   ├── dashboard.css
│   │   │   └── landing.css
│   │   │
│   │   └── js/
│   │       ├── auth.js
│   │       ├── kasir.js
│   │       ├── router.js
│   │       ├── script.js
│   │       └── stok_produk.js
│   │
│   ├── app/
│   │   ├── index.html
│   │   └── pages/
│   │       ├── dashboard.html
│   │       ├── kasir.html
│   │       ├── laporan.html
│   │       └── stok_produk.html
│   │
│   ├── api/
│   │   └── index.php
│   │
│   ├── templates/
│   │   ├── header.html
│   │   └── footer.html
│   │
│   └── cek/
│       └── test.php
│
└── src/
    ├── Controller/
    │   ├── AuthController.php
    │   └── ProdukController.php
    │
    └── Database/
        └── koneksi.php
```

---

# 🏛 Arsitektur Sistem

ElkPOS menerapkan arsitektur **Layered Architecture** dengan konsep **Single Page Application (SPA)**.

Seluruh halaman aplikasi dimuat menggunakan JavaScript sehingga browser tidak perlu melakukan reload halaman setiap kali berpindah menu.

Alur sistem:

```text
Browser
    │
    ▼
HTML + CSS + JavaScript
    │
Fetch API
    │
    ▼
public/api/index.php
    │
Central Router
    │
    ▼
Controller
    │
    ▼
Database (MySQL)
```

---

# 📁 Penjelasan Folder

## Root Directory

Berisi konfigurasi utama aplikasi.

| File | Keterangan |
|------|------------|
| docker-compose.yml | Konfigurasi Docker |
| nginx.conf | Konfigurasi Web Server |
| init.sql | Database awal |
| README.md | Dokumentasi proyek |

---

## public/

Merupakan satu-satunya folder yang dapat diakses langsung oleh browser.

Folder ini berisi:

- Landing Page
- Login
- Asset CSS
- Asset JavaScript
- Template HTML
- Halaman SPA
- API Entry Point

---

## public/assets/

Berisi seluruh aset frontend.

### css/

Berisi stylesheet aplikasi.

- auth.css
- dashboard.css
- landing.css

### js/

Berisi seluruh logika frontend.

- router.js
- auth.js
- kasir.js
- stok_produk.js
- script.js

---

## public/app/

Merupakan area utama aplikasi setelah pengguna berhasil login.

### pages/

Berisi halaman-halaman SPA.

- Dashboard
- Kasir
- Laporan
- Stok Produk

---

## public/api/

Berisi satu file utama:

```text
index.php
```

File ini bertugas sebagai **Central API Router**.

Semua request API akan masuk melalui file ini sebelum diteruskan ke Controller yang sesuai.

---

## src/

Folder ini bersifat privat sehingga tidak dapat diakses langsung melalui browser.

Berisi seluruh logika bisnis aplikasi.

---

## src/Controller/

Berisi Controller aplikasi.

Saat ini terdiri dari:

- AuthController.php
- ProdukController.php

Controller bertugas menerima request dari API, memproses data, kemudian mengembalikan response ke frontend.

---

## src/Database/

Berisi konfigurasi koneksi database.

Saat ini menggunakan:

```text
koneksi.php
```

---

# 🔄 Cara Kerja SPA

Ketika pengguna memilih menu:

```text
Dashboard

↓

router.js

↓

Fetch dashboard.html

↓

Konten dimuat ke dalam index.html

↓

Tanpa Reload Browser
```

Keuntungan:

- Lebih cepat
- Lebih ringan
- Pengalaman pengguna lebih baik

---

# 🗄 Database

Database menggunakan MySQL.

Saat ini menggunakan file:

```text
init.sql
```

Database menyimpan data seperti:

- User
- Produk
- Kategori
- Transaksi
- Detail Transaksi

---

# 🔐 Keamanan

Beberapa konsep keamanan yang diterapkan:

- Folder `src` tidak dapat diakses publik.
- Semua API menggunakan Central Routing.
- Validasi request dilakukan pada Controller.
- Koneksi database dipisahkan dari folder publik.
- Struktur proyek mengikuti prinsip Separation of Concerns (SoC).

---

# 🐳 Docker

Aplikasi dijalankan menggunakan Docker sehingga seluruh environment menjadi konsisten.

Container yang digunakan:

- Nginx
- PHP
- MySQL

Menjalankan aplikasi:

```bash
docker-compose up -d
```

Menghentikan aplikasi:

```bash
docker-compose down
```

---

# ▶ Instalasi

## 1. Clone Repository

```bash
git clone https://github.com/username/elkpos.git
```

---

## 2. Masuk ke Folder

```bash
cd pos
```

---

## 3. Jalankan Docker

```bash
docker-compose up -d
```

---

## 4. Import Database

Import file:

```text
init.sql
```

ke dalam database MySQL.

---

## 5. Jalankan Aplikasi

Buka browser:

```text
http://localhost:8080
```

---

# 📈 Roadmap Pengembangan

Fitur yang akan dikembangkan selanjutnya:

- Manajemen Kategori
- Manajemen Supplier
- Manajemen Pelanggan
- Pembelian Barang
- Return Barang
- Export PDF
- Export Excel
- Grafik Penjualan
- Backup Database
- Dashboard Analytics
- Hak Akses Multi Role
- Audit Log
- REST API

---

# 📚 Prinsip Software Engineering

Selama pengembangan proyek ini diterapkan beberapa prinsip berikut.

## Separation of Concerns (SoC)

Memisahkan:

- HTML
- CSS
- JavaScript
- PHP
- Database

---

## Don't Repeat Yourself (DRY)

Menghindari duplikasi kode dengan membuat fungsi dan struktur yang dapat digunakan kembali.

---

## Layered Architecture

Membagi aplikasi menjadi beberapa lapisan agar lebih mudah dipelihara.

---

## Modular Programming

Setiap fitur dibuat dalam modul terpisah sehingga mudah dikembangkan.

---

## Security First

Mengutamakan keamanan dengan memisahkan logika bisnis dari folder publik.

---

# 🎯 Tujuan Proyek

Proyek ElkPOS dibuat sebagai media pembelajaran Full Stack Web Development menggunakan teknologi native tanpa framework besar.

Selain itu proyek ini bertujuan untuk menerapkan praktik terbaik dalam:

- Software Engineering
- Clean Code
- Layered Architecture
- Docker Development
- Single Page Application
- PHP Native
- JavaScript Vanilla

---

# 📝 Lisensi

Proyek ini dibuat untuk keperluan pembelajaran, pengembangan perangkat lunak, dan implementasi sistem Point of Sales berbasis web.