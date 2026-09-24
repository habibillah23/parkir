# Sistem Parkir (Laravel + Tailwind CSS)

Aplikasi web manajemen parkir dengan 3 role: **Admin**, **Petugas**, **Owner**.

## Fitur per Role

| Fitur | Admin | Petugas | Owner |
|---|---|---|---|
| Login / Logout | ✅ | ✅ | ✅ |
| CRUD User | ✅ | ❌ | ❌ |
| CRUD Tarif Parkir | ✅ | ❌ | ❌ |
| CRUD Area Parkir | ✅ | ❌ | ❌ |
| CRUD Kendaraan | ✅ | ❌ | ❌ |
| Log Aktivitas | ✅ | ❌ | ❌ |
| Transaksi (masuk/keluar) | ❌ | ✅ | ❌ |
| Cetak Struk Parkir | ❌ | ✅ | ❌ |
| Rekap Transaksi (per rentang tanggal) | ❌ | ❌ | ✅ |

Akses dibatasi lewat middleware `role` (`app/Http/Middleware/CheckRole.php`) yang dipasang per grup route di `routes/web.php`.

## ⚠️ Catatan penting

Kode ini berisi **source code aplikasi** (migrations, models, controllers, middleware, routes, views) — bukan instalasi Laravel yang lengkap dengan folder `vendor/`, karena proses pembuatannya tidak memiliki akses internet untuk menjalankan `composer install`. Silakan ikuti langkah instalasi di bawah untuk menjalankannya di komputer Anda (butuh koneksi internet & PHP/Composer terpasang).

## Cara Instalasi

1. **Buat project Laravel baru** (gunakan Laravel 11):
   ```bash
   composer create-project laravel/laravel parkir-app
   cd parkir-app
   ```

2. **Salin semua file dari paket ini** ke dalam folder project, timpa file yang sudah ada:
   - `app/Helpers/` → `app/Helpers/`
   - `app/Http/Controllers/` → `app/Http/Controllers/`
   - `app/Http/Middleware/CheckRole.php` → `app/Http/Middleware/`
   - `app/Models/` → `app/Models/` (timpa `User.php` bawaan)
   - `database/migrations/` → `database/migrations/`
   - `database/seeders/RoleUserSeeder.php` → `database/seeders/`
   - `routes/web.php` → `routes/web.php` (timpa)
   - `resources/views/` → `resources/views/` (timpa `dashboard.blade.php` jika ada)

3. **Daftarkan middleware `role`.** Buka `bootstrap/app.php` dan tambahkan di dalam `->withMiddleware()`:
   ```php
   ->withMiddleware(function (Middleware $middleware) {
       $middleware->alias([
           'role' => \App\Http\Middleware\CheckRole::class,
       ]);
   })
   ```
   > Jika Anda menggunakan Laravel 10 (struktur `app/Http/Kernel.php`), tambahkan baris berikut ke array `$middlewareAliases`:
   > ```php
   > 'role' => \App\Http\Middleware\CheckRole::class,
   > ```

4. **Panggil seeder** dari `database/seeders/DatabaseSeeder.php`:
   ```php
   public function run(): void
   {
       $this->call(RoleUserSeeder::class);
   }
   ```

5. **Konfigurasi database** di file `.env` (contoh MySQL):
   ```env
   DB_CONNECTION=mysql
   DB_DATABASE=parkir_app
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Jalankan migrasi & seeder**:
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan server**:
   ```bash
   php artisan serve
   ```
   Buka `http://127.0.0.1:8000`.

## Akun Default (dari seeder)

| Role | Email | Password |
|---|---|---|
| Admin | admin@parkir.test | password |
| Petugas | petugas@parkir.test | password |
| Owner | owner@parkir.test | password |

**Segera ganti password default ini setelah login pertama kali.**

## Alur Kerja Transaksi (Petugas)

1. Petugas login → menu **Catat Kendaraan Masuk** → input plat nomor, jenis kendaraan, area → sistem membuat tiket & menghitung tarif otomatis berdasarkan tabel Tarif Parkir.
2. Struk tiket masuk bisa langsung dicetak (`window.print()`).
3. Saat kendaraan keluar, petugas membuka transaksi tersebut → **Proses Keluar** → sistem menghitung total biaya otomatis berdasarkan durasi parkir dan tarif jam pertama/berikutnya (dengan batas maksimal harian jika diatur).
4. Struk transaksi selesai (dengan total bayar) dapat dicetak.

## Perhitungan Tarif

Logika ada di `app/Models/TarifParkir.php` method `hitungBiaya()`:
- Jam pertama dikenakan `tarif_jam_pertama`.
- Setiap jam berikutnya (dibulatkan ke atas) dikenakan `tarif_jam_berikutnya`.
- Jika `tarif_maksimal_harian` diisi, total tidak akan melebihi batas tersebut per hari.

## Catatan Teknis

- Styling menggunakan **Tailwind CSS via CDN** (tidak perlu build step/npm) — cukup untuk pengembangan cepat. Untuk produksi, disarankan migrasi ke Tailwind via Vite (`npm install` + `npm run build`) agar lebih optimal.
- Semua aktivitas penting (login, logout, tambah/ubah/hapus data master, transaksi masuk/keluar) tercatat otomatis ke tabel `activity_logs` lewat helper `App\Helpers\ActivityLogger::log()`.
- Route diproteksi berlapis: middleware `auth` (harus login) + middleware `role:xxx` (harus role tertentu) — role lain akan mendapat halaman 403.
