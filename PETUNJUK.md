# Rak-buku-digital — petunjuk pemasangan (Laragon)

1. Laragon: klik kanan > Quick app > Laravel, beri nama **Rak-buku-digital**
   (atau jalankan `composer create-project laravel/laravel Rak-buku-digital` di C:\laragon\www).
2. Salin isi folder ini ke folder proyek, timpa file yang sama (routes/web.php, DatabaseSeeder.php).
3. Buka HeidiSQL, buat database **koleksi_buku** (utf8mb4_unicode_ci).
4. Edit `.env` proyek:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=koleksi_buku
   DB_USERNAME=root
   DB_PASSWORD=
5. Terminal Laragon, di folder proyek:
   php artisan migrate:fresh --seed
6. Buka http://rak-buku-digital.test (atau `php artisan serve` lalu http://127.0.0.1:8000).

Akun awal: admin@rakbuku.test / admin12345
