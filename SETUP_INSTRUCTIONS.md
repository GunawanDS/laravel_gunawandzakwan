# Instruksi Setup Aplikasi Sistem Rumah Sakit

## Persyaratan
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL/MariaDB
- XAMPP (sudah terinstall)

## Langkah-langkah Setup

### 1. Konfigurasi Database
Pastikan database `db_hospital` sudah dibuat di MySQL/MariaDB.

### 2. Konfigurasi Environment
Pastikan file `.env` sudah dikonfigurasi dengan benar:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=db_hospital
DB_USERNAME=root
DB_PASSWORD=root
```

### 3. Generate Application Key
Jalankan perintah berikut untuk generate application key:
```bash
php artisan key:generate
```

### 4. Jalankan Migration
Jalankan migration untuk membuat tabel:
```bash
php artisan migrate
```

### 5. Jalankan Seeder
Jalankan seeder untuk membuat user default:
```bash
php artisan db:seed
```

### 6. Start Server
Jalankan server Laravel:
```bash
php artisan serve
```

## Login Default
- **Username**: admin
- **Password**: password

## Fitur Aplikasi

### 1. Authentication
- Login menggunakan username (bukan email)
- Halaman login yang user-friendly dengan Bootstrap

### 2. Dashboard
- Statistik total rumah sakit dan pasien
- Data rumah sakit dan pasien terbaru
- Menu cepat untuk menambah data

### 3. CRUD Rumah Sakit
- **Create**: Tambah data rumah sakit baru
- **Read**: Lihat daftar dan detail rumah sakit
- **Update**: Edit data rumah sakit
- **Delete**: Hapus data rumah sakit

### 4. CRUD Pasien
- **Create**: Tambah data pasien baru
- **Read**: Lihat daftar dan detail pasien
- **Update**: Edit data pasien
- **Delete**: Hapus data pasien dengan AJAX
- **Filter**: Dropdown filter berdasarkan rumah sakit

### 5. Relasi Database
- Tabel `patients` memiliki relasi dengan tabel `hospitals`
- Foreign key `hospital_id` pada tabel `patients`

### 6. UI/UX
- Menggunakan Bootstrap 5 untuk styling
- jQuery untuk interaksi AJAX
- Responsive design
- User-friendly interface

## Struktur Database

### Tabel `hospitals`
- `id` (Primary Key)
- `nama_rumah_sakit`
- `alamat`
- `email`
- `telepon`
- `created_at`
- `updated_at`

### Tabel `patients`
- `id` (Primary Key)
- `nama_pasien`
- `alamat`
- `no_telpon`
- `hospital_id` (Foreign Key)
- `created_at`
- `updated_at`

### Tabel `users`
- `id` (Primary Key)
- `name`
- `username` (untuk login)
- `email`
- `password`
- `created_at`
- `updated_at`

## URL Aplikasi
- **Login**: http://localhost:8000/login
- **Dashboard**: http://localhost:8000/dashboard
- **Rumah Sakit**: http://localhost:8000/hospitals
- **Pasien**: http://localhost:8000/patients

## Catatan
- Pastikan XAMPP sudah running (Apache dan MySQL)
- Database `db_hospital` harus sudah dibuat sebelum menjalankan migration
- Aplikasi menggunakan session untuk authentication
- Semua halaman CRUD sudah dilindungi dengan middleware auth
