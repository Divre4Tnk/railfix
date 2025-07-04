
# Railfix

Sistem Aplikasi Website untuk pencatatan dan tracking perbaikan barang untuk Workshop IT Support PT. Kereta Api Indonesia (Persero) Divre IV Tanjung Karang. Aplikasi website ini dikerjakan sebagai proyek akhir magang mandiri.
### Anggota Tim
Anggota tim yang terlibat dalam pembuatan aplikasi website ini antara lain :
| Nama | NPM | Sebagai |
|---|---|---|
| Prayogi Setiawan | 22312009 | Project Manager |
| Mukhlis Khoirudin | 22312008 | Backend Developer |
| Muhammad Endi | 22312023 | Backend Developer |
| Rama Wijaya | 22312029 | Frontend Developer |

### Tech Stack

**Frontend:** Blade, HTML, Bootstrap CSS

**Backend:** Laravel, PHP

**Database:** MySQL


### Installation

Install railfix dengan `composer` dan `php > 8.4`

- Clone repository ini ke perangkat anda.
- Pastikan sudah menginstall composer.
- Buka terminal di dalam folder project dan install dependency `composer install`.
- Copy file `.env.exampe` menjadi `.env`.
- Generate `APP_KEY` dengan `php artisan key:generate`.
- Migrasi database `php artisan migrate`.
- Jalankan server  `php artisan serve`.
