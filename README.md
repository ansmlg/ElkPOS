# 📦 ElkPOS - Enterprise Point of Sales System

> **Status:** 🚧 Work in Progress (Dalam Pengembangan)

ElkPOS adalah aplikasi **Enterprise Point of Sales (POS)** modern yang dirancang khusus untuk toko elektronik. Aplikasi ini dibangun menggunakan arsitektur **Single Page Application (SPA)** menggunakan **JavaScript Vanilla** pada sisi frontend dan **PHP Native** pada sisi backend.

Proyek ini dibuat sebagai media pembelajaran sekaligus implementasi praktik terbaik dalam pengembangan aplikasi web modern menggunakan teknologi native tanpa framework besar. Fokus utama pengembangan adalah menghasilkan aplikasi yang memiliki struktur kode yang rapi, mudah dipelihara, aman, dan mudah dikembangkan.

> **Catatan:** Proyek ini masih dalam tahap pengembangan aktif. Dokumentasi, struktur folder, dan fitur dapat berubah seiring proses pengembangan.

---

# 🎯 Tujuan Proyek

Tujuan utama pengembangan ElkPOS adalah:

- Membangun aplikasi kasir modern berbasis web.
- Menerapkan prinsip Software Engineering dalam proyek nyata.
- Mempelajari arsitektur Single Page Application (SPA).
- Mengimplementasikan PHP Native menggunakan pendekatan Object Oriented Programming (OOP).
- Menggunakan Docker sebagai development environment.
- Membuat struktur proyek yang aman, modular, dan mudah dikembangkan.

---

# 🚀 Fitur

## ✅ Fitur yang Sudah Tersedia

- Struktur proyek berbasis Layered Architecture
- Single Page Application (SPA)
- Docker Development Environment
- Konfigurasi Nginx
- Central API Routing
- Landing Page
- Halaman Login
- Dashboard Layout
- Halaman Kasir
- Halaman Stok Produk
- Halaman Laporan
- Routing halaman menggunakan JavaScript

---

## 🚧 Fitur yang Sedang Dikembangkan

- Sistem Login
- Session Authentication
- Dashboard Dinamis
- CRUD Produk
- CRUD Stok Produk
- Sistem Transaksi
- Validasi Form
- API Response
- Integrasi Database

---

## 📌 Fitur yang Direncanakan

- Dashboard Analytics
- Barcode Scanner
- Serial Number Management
- Manajemen Garansi
- Manajemen Supplier
- Manajemen Pelanggan
- Multi Role User
- Export PDF
- Export Excel
- Backup Database
- Audit Log
- REST API Documentation

---

# 🛠️ Tech Stack

## Frontend

- HTML5
- CSS3
- JavaScript (Vanilla)
- Fetch API
- Bootstrap 5

## Backend

- PHP Native
- Object Oriented Programming (OOP)
- Controller Pattern

## Database

- MySQL 8.0

## Infrastructure

- Docker
- Docker Compose
- Nginx
- PHP-FPM

---

# 🏗️ Arsitektur Sistem

ElkPOS menggunakan pendekatan **Layered Architecture** dan **Single Page Application (SPA)**.

Semua request dari frontend akan dikirim menggunakan **Fetch API** menuju satu pintu API (**Central Router**) sebelum diteruskan ke Controller yang sesuai.

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
Database
```

Pendekatan ini membuat aplikasi lebih mudah dipelihara, lebih aman, dan lebih mudah dikembangkan ketika jumlah fitur semakin bertambah.

---

# 📂 Struktur Proyek

```text
pos/
├── docker-compose.yml
├── init.sql
├── nginx.conf
├── README.md
│
├── public
│   ├── api
│   │   └── index.php
│   ├── app
│   │   ├── index.html
│   │   └── pages
│   │       ├── dashboard.html
│   │       ├── kasir.html
│   │       ├── laporan.html
│   │       └── stok_produk.html
│   ├── assets
│   │   ├── css
│   │   │   ├── auth.css
│   │   │   ├── dashboard.css
│   │   │   └── landing.css
│   │   └── js
│   │       ├── auth.js
│   │       ├── kasir.js
│   │       ├── router.js
│   │       ├── script.js
│   │       └── stok_produk.js
│   ├── auth
│   │   └── login.html
│   ├── cek
│   │   └── test.php
│   ├── index.html
│   └── templates
│       ├── footer.html
│       └── header.html
│
└── src
    ├── Controller
    │   ├── AuthController.php
    │   └── ProdukController.php
    └── Database
        └── koneksi.php
```

---

# 📁 Penjelasan Folder

## `public/`

Merupakan satu-satunya folder yang dapat diakses langsung oleh browser.

Berisi:

- Landing Page
- Login
- Asset CSS
- Asset JavaScript
- Halaman SPA
- API Entry Point

---

## `public/app/`

Merupakan area utama aplikasi setelah pengguna berhasil login.

Folder ini berisi halaman-halaman SPA seperti:

- Dashboard
- Kasir
- Laporan
- Stok Produk

---

## `public/api/`

Berisi file:

```text
index.php
```

File ini berfungsi sebagai **Central API Router**.

Seluruh request API akan diproses melalui file ini sebelum diteruskan ke Controller.

---

## `src/`

Folder privat yang tidak dapat diakses langsung oleh browser.

Folder ini menyimpan seluruh logika bisnis aplikasi.

---

## `src/Controller/`

Berisi seluruh Controller aplikasi.

Saat ini terdiri dari:

- AuthController
- ProdukController

Controller bertugas menerima request dari API kemudian memproses data sebelum dikirim kembali ke frontend.

---

## `src/Database/`

Berisi konfigurasi koneksi database.

Saat ini menggunakan:

```text
koneksi.php
```

---

# 🗄️ Database

Database menggunakan MySQL.

Seluruh struktur database berada pada file:

```text
init.sql
```

Database dirancang untuk mendukung fitur:

- User
- Produk
- Kategori
- Transaksi
- Detail Transaksi
- Manajemen Stok

Struktur database akan terus berkembang mengikuti kebutuhan aplikasi.

---

# 🔄 Cara Kerja SPA

Ketika pengguna membuka menu aplikasi:

```text
Klik Menu

↓

router.js

↓

Fetch HTML

↓

Konten dimuat

↓

Tanpa Reload Browser
```

Keuntungan pendekatan SPA:

- Lebih cepat
- Lebih responsif
- Mengurangi beban server
- Pengalaman pengguna lebih baik

---

# 🔐 Keamanan

Beberapa konsep keamanan yang diterapkan pada proyek ini:

- Folder `src` tidak dapat diakses secara langsung.
- Seluruh request API menggunakan Central Routing.
- Pemisahan antara frontend dan backend.
- Struktur kode mengikuti prinsip Separation of Concerns (SoC).
- Persiapan penggunaan Prepared Statement untuk mencegah SQL Injection.
- Validasi input pada sisi backend.

---

# 🐳 Menjalankan Proyek

## Clone Repository

```bash
git clone https://github.com/username/elkpos.git
```

---

## Masuk ke Folder

```bash
cd pos
```

---

## Jalankan Docker

```bash
docker-compose up -d
```

---

## Import Database

Import file berikut ke MySQL.

```text
init.sql
```

---

## Buka Browser

```text
http://localhost:8080
```

---

# 📈 Progress Pengembangan

| Modul | Status |
|--------|:------:|
| Struktur Proyek | ✅ |
| Docker Environment | ✅ |
| Konfigurasi Nginx | ✅ |
| Landing Page | ✅ |
| SPA Routing | ✅ |
| Login | 🚧 |
| Dashboard | 🚧 |
| Produk | 🚧 |
| Kasir | 🚧 |
| Laporan | 🚧 |
| Database | 🚧 |
| Session Login | 🚧 |
| Multi Role | ⏳ |
| Supplier | ⏳ |
| Customer | ⏳ |
| Backup Database | ⏳ |
| Dashboard Analytics | ⏳ |
| Export PDF | ⏳ |
| Export Excel | ⏳ |

### Keterangan

- ✅ Selesai
- 🚧 Sedang Dikembangkan
- ⏳ Belum Dimulai

---

# 📋 Roadmap

## Versi 0.1

- Struktur proyek
- Docker
- Landing Page
- SPA

---

## Versi 0.2

- Login
- Dashboard
- CRUD Produk
- CRUD Stok

---

## Versi 0.3

- Sistem Kasir
- Transaksi
- Detail Transaksi

---

## Versi 0.4

- Multi Role
- Laporan
- Dashboard Analytics

---

## Versi 1.0

- Sistem POS siap digunakan.
- Dokumentasi lengkap.
- Optimasi performa.
- Peningkatan keamanan.
- Deployment ke server produksi.

---

# 📚 Prinsip Software Engineering

Selama pengembangan ElkPOS diterapkan beberapa prinsip berikut:

## Separation of Concerns (SoC)

Memisahkan tampilan, logika aplikasi, dan akses database agar kode lebih terstruktur.

## Don't Repeat Yourself (DRY)

Mengurangi duplikasi kode dengan membuat fungsi yang dapat digunakan kembali.

## Layered Architecture

Memisahkan aplikasi menjadi beberapa lapisan sehingga mudah dipelihara dan dikembangkan.

## Modular Programming

Setiap fitur dikembangkan dalam modul terpisah agar tidak saling bergantung.

## Security First

Mengutamakan keamanan sejak tahap awal pengembangan.

---

# 🤝 Kontribusi

Karena proyek ini masih dalam tahap pengembangan, masukan, saran, maupun kontribusi sangat terbuka untuk membantu meningkatkan kualitas aplikasi.

---

# ⚠️ Disclaimer

ElkPOS merupakan proyek yang masih berada pada tahap **Work in Progress (WIP)**.

Beberapa fitur, struktur folder, dokumentasi, maupun implementasi teknis masih dapat berubah mengikuti proses pengembangan. README ini akan diperbarui secara berkala agar tetap sesuai dengan perkembangan proyek.

---

# 📄 Lisensi

Proyek ini dikembangkan untuk tujuan pembelajaran, pengembangan portofolio, dan implementasi konsep Software Engineering dalam pembangunan aplikasi Point of Sales berbasis web.