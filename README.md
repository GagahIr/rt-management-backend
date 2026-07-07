# 🏘️ RT Management Backend

Backend aplikasi **RT Management** yang dibangun menggunakan **Laravel 10** dan **Vite**.

Repository ini merupakan **REST API** yang digunakan oleh aplikasi frontend RT Management.

> 🎨 **Frontend Repository**
>
> https://github.com/GagahIr/rt-management-frontend

Frontend akan mengonsumsi seluruh endpoint API yang disediakan oleh backend ini. Oleh karena itu, backend harus dijalankan terlebih dahulu sebelum menjalankan aplikasi frontend.

---

# 📋 System Requirements

Pastikan perangkat Anda telah terinstal software berikut:

| Software | Minimum Version |
|----------|-----------------|
| PHP | **8.1.22** |
| MySQL | **8.2** |
| Composer | Latest Version |
| Node.js | LTS Version |
| NPM | Latest Version |
| Git | Latest Version *(Opsional jika menggunakan ZIP)* |

---

# 🚀 Installation Guide

## 1. Clone Repository

Clone repository ke komputer Anda.

```bash
git clone https://github.com/GagahIr/rt-management-backend.git
cd rt-management-backend
```

---

## 2. Install PHP Dependencies

Install seluruh dependency Laravel menggunakan Composer.

```bash
composer install
```

---

## 3. Install Frontend Dependencies

Install dependency frontend menggunakan NPM.

```bash
npm install
```

---

## 4. Configure Environment

Salin file environment.

```bash
cp .env.example .env
```

> **Windows (CMD)**

```cmd
copy .env.example .env
```

Kemudian buka file `.env` dan sesuaikan konfigurasi database.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rt-management
DB_USERNAME=root
DB_PASSWORD=
```

> **Note**
>
> Isi `DB_PASSWORD` apabila MySQL Anda menggunakan password.

---

## 5. Generate Application Key

Laravel membutuhkan **Application Key** untuk keamanan session dan enkripsi data.

```bash
php artisan key:generate
```

---

## 6. Create Database & Run Migration

Buat database baru dengan nama:

```text
rt-management
```

Kemudian jalankan migration.

```bash
php artisan migrate
```

---

## 7. Create Storage Link

Agar file upload dapat diakses melalui browser, jalankan:

```bash
php artisan storage:link
```

---

# ▶️ Running the Application

Proyek ini menggunakan **Laravel** sebagai backend

Jalankan **dua terminal** secara bersamaan.

## Terminal 1 — Laravel Server

```bash
php artisan serve
```

Server akan berjalan di:

```
http://127.0.0.1:8000
```

---

# 📂 Project Structure

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
vendor/
```

---

# 🛠 Useful Commands

| Command | Description |
|----------|-------------|
| `composer install` | Install PHP dependencies |
| `npm install` | Install frontend dependencies |
| `php artisan key:generate` | Generate application key |
| `php artisan migrate` | Run database migration |
| `php artisan storage:link` | Create symbolic storage link |
| `php artisan serve` | Run Laravel server |
| `npm run dev` | Run Vite development server |
| `npm run build` | Build frontend assets |

---

# 📌 Notes

- Pastikan **MySQL Server** sedang berjalan.
- Pastikan database **rt-management** telah dibuat sebelum menjalankan migration.
- Jalankan **Laravel** dan **Vite** secara bersamaan saat proses development.
- Jangan menghapus file `.env` setelah konfigurasi selesai.

---

# 👨‍💻 Tech Stack

- Laravel 10
- PHP 8.1+
- MySQL
- Vite
- Node.js
- Composer

---

# 📄 License

This project is intended for educational and development purposes.