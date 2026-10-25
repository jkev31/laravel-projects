<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <a href="https://laravel.com/docs/13.x"><img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel Version"></a>
  <a href="https://www.php.net/releases/8.3"><img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php" alt="PHP Version"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License"></a>
</p>

---

# 🛒 Mini POS — Latihan 005

Aplikasi **Point of Sale (POS) sederhana** berbasis web yang dibangun dengan Laravel 13. Mendukung manajemen barang (Items) dan pencatatan transaksi penjualan lengkap dengan detail item, auto-generate nomor invoice, serta pengurangan stok otomatis.

---

## ✨ Fitur Utama

- **📦 Manajemen Barang (Items)**
  - Tambah, edit, dan hapus barang
  - Pencatatan nama, deskripsi, harga, dan stok
  - CRUD via AJAX (tanpa reload halaman)

- **🧾 Transaksi Penjualan**
  - Buat transaksi baru dengan multiple item sekaligus
  - Auto-generate nomor invoice format `TRX-YYYYmmddHHiiss`
  - Kalkulasi subtotal & grand total otomatis di sisi server
  - Pengurangan stok barang otomatis setiap transaksi
  - Lihat detail transaksi beserta item yang dibeli

- **🔒 Database Transaction**
  - Menggunakan `DB::beginTransaction()` / `commit()` / `rollBack()` untuk menjaga integritas data

---

## 🗄️ Struktur Database

### Tabel `items`

| Kolom         | Tipe              | Keterangan              |
|---------------|-------------------|-------------------------|
| `id`          | bigint (PK)       | Primary key             |
| `name`        | string            | Nama barang             |
| `description` | text (nullable)   | Deskripsi barang        |
| `price`       | decimal(12,2)     | Harga barang            |
| `stock`       | integer           | Jumlah stok             |
| `created_at`  | timestamp         | —                       |
| `updated_at`  | timestamp         | —                       |

### Tabel `transactions`

| Kolom              | Tipe              | Keterangan                    |
|--------------------|-------------------|-------------------------------|
| `id`               | bigint (PK)       | Primary key                   |
| `invoice_number`   | string (unique)   | Nomor invoice unik            |
| `description`      | string (nullable) | Keterangan transaksi          |
| `transaction_date` | date              | Tanggal transaksi             |
| `total_amount`     | decimal(12,2)     | Total nilai transaksi         |
| `created_at`       | timestamp         | —                             |
| `updated_at`       | timestamp         | —                             |

### Tabel `transaction_details`

| Kolom            | Tipe          | Keterangan                          |
|------------------|---------------|-------------------------------------|
| `id`             | bigint (PK)   | Primary key                         |
| `transaction_id` | foreignId     | FK → `transactions.id` (cascade)    |
| `item_id`        | foreignId     | FK → `items.id` (cascade)           |
| `price`          | decimal(12,2) | Harga satuan saat transaksi         |
| `quantity`       | integer       | Jumlah barang                       |
| `subtotal`       | decimal(12,2) | Subtotal (price × quantity)         |
| `created_at`     | timestamp     | —                                   |
| `updated_at`     | timestamp     | —                                   |

---

## 🌐 Routes

| Method   | URL                        | Controller                      | Fungsi                        |
|----------|----------------------------|---------------------------------|-------------------------------|
| `GET`    | `/items`                   | `ItemController@index`          | Daftar semua barang           |
| `POST`   | `/items`                   | `ItemController@store`          | Tambah barang baru            |
| `PUT`    | `/items`                   | `ItemController@update`         | Edit data barang              |
| `DELETE` | `/items`                   | `ItemController@destroy`        | Hapus barang                  |
| `GET`    | `/transactions`            | `TransactionController@index`   | Daftar semua transaksi        |
| `GET`    | `/transactions/create`     | `TransactionController@create`  | Form buat transaksi baru      |
| `POST`   | `/transactions`            | `TransactionController@store`   | Simpan transaksi (JSON)       |
| `GET`    | `/transactions/show/{id}`  | `TransactionController@show`    | Detail transaksi              |

---

## 🚀 Instalasi & Setup

### Prasyarat

- PHP **^8.3**
- Composer
- Node.js & NPM
- MySQL / MariaDB (atau database lain yang didukung Laravel)
- Laragon / XAMPP / Herd *(opsional, untuk local server)*

### Langkah-langkah

**1. Clone / salin project**

```bash
git clone https://github.com/jkev31/laravel-projects.git
cd laravel-projects/latihan005
```

**2. Install dependensi PHP**

```bash
composer install
```

**3. Salin file environment**

```bash
cp .env.example .env
```

**4. Generate application key**

```bash
php artisan key:generate
```

**5. Konfigurasi database**

Edit file `.env` dan sesuaikan pengaturan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=latihan005
DB_USERNAME=root
DB_PASSWORD=
```

**6. Jalankan migrasi**

```bash
php artisan migrate
```

**7. Install dependensi frontend & build assets**

```bash
npm install
npm run build
```

**8. Jalankan development server**

```bash
php artisan serve
```

> Atau gunakan shortcut Composer yang sudah dikonfigurasi:
> ```bash
> composer run dev
> ```

Aplikasi akan berjalan di **http://localhost:8000**

---

## 📁 Struktur Direktori Utama

```
latihan005/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ItemController.php         # CRUD Barang
│   │       └── TransactionController.php  # CRUD Transaksi
│   └── Models/
├── database/
│   └── migrations/
│       ├── ..._create_items_table.php
│       ├── ..._create_transactions_table.php
│       └── ..._create_transaction_details_table.php
├── resources/
│   └── views/
│       ├── items/
│       │   └── index.blade.php            # Halaman daftar & form barang
│       └── Transactions/
│           ├── index.blade.php            # Daftar transaksi
│           ├── create.blade.php           # Form transaksi baru
│           └── show.blade.php             # Detail transaksi
└── routes/
    └── web.php                            # Definisi route
```

---

## 🛠️ Tech Stack

| Layer       | Teknologi                         |
|-------------|-----------------------------------|
| Framework   | Laravel 13                        |
| Language    | PHP 8.3                           |
| Database    | MySQL / MariaDB                   |
| Query       | Laravel Query Builder (`DB::`)    |
| Frontend    | Blade Templates + Vite            |
| Validation  | Laravel Validator                 |
| API Style   | JSON Response (AJAX-friendly)     |

---

## 📝 Catatan Pengembangan

- Proyek ini merupakan **latihan** — tidak menggunakan Eloquent Model secara penuh, melainkan **Query Builder** (`DB::table(...)`) langsung untuk memahami konsep dasar query Laravel.
- Harga barang pada `ItemController@store` dan `@update` dikalikan `18000` (asumsi konversi kurs dari USD ke IDR pada input form).
- Semua operasi tulis pada transaksi dibungkus dalam **database transaction** untuk menjamin konsistensi data.

---

## 📄 Lisensi

Proyek ini bersifat open-source dan tersedia di bawah lisensi [MIT](https://opensource.org/licenses/MIT).
