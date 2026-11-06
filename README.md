# Apotek Terintegrasi (Laravel + MySQL + API Postman)

Aplikasi web apotek berbasis **Laravel** dengan database **MySQL** untuk mengelola **Pelanggan**, **Staf Apotek**, dan **Daftar Obat**.
Seluruh data juga dapat diakses melalui **REST API** yang diuji dengan **Postman**.

Projek kelompok mata kuliah Teknologi Sistem Terintegrasi - Politeknik Negeri Lhokseumawe.

## Fitur
- Form Pelanggan (Id, Nama, Alamat, No HP)
- Form Staf Apotek (Id, Nama, Alamat, Tanggal Lahir, Tempat Lahir, No HP)
- Form Daftar Obat (Kode, Nama, Stok, Tanggal Kadaluarsa) dengan penanda status kadaluarsa
- Daftar data dengan pencarian, pagination, ubah, dan hapus
- Validasi input (Form Request) dan data contoh (factory + seeder)
- REST API (JSON) untuk ketiga data, siap diuji dengan Postman

## Kebutuhan
PHP 8.3+, Composer, MySQL, Git (paling mudah memakai **Laragon**).

## Menjalankan project dari GitHub
```bash
git clone https://github.com/Guard-69/Apotek-Teratai.git
cd Apotek-Teratai
composer install
copy .env.example .env        # Windows (Mac/Linux: cp .env.example .env)
php artisan key:generate
php artisan migrate --seed    # jawab yes bila diminta membuat database db_apotek
php artisan serve
```
Buka http://127.0.0.1:8000 di browser. Pastikan MySQL (Laragon > Start All) sudah menyala.

## Endpoint API (prefix `/api`)
| Method | URL | Fungsi |
|---|---|---|
| GET | `/api/pelanggan`, `/api/staf`, `/api/obat` | Daftar (10 per halaman, parameter `q` untuk cari) |
| GET | `/api/{data}/{id}` | Detail |
| POST | `/api/{data}` | Tambah (body JSON) |
| PUT / PATCH | `/api/{data}/{id}` | Ubah (body JSON lengkap) |
| DELETE | `/api/{data}/{id}` | Hapus |

### Body untuk Pelanggan ({{base_url}}/pelanggan):
```json
{
  "nama": "Guard",
  "alamat": "Jl. Merdeka No. 10, Lhokseumawe",
  "no_hp": "081234567890"
}
```
### Body untuk Staf Apotek ({{base_url}}/staf):
```
{
  "nama": "Knight",
  "alamat": "Jl. Iskandar Muda No. 5, Lhokseumawe",
  "tanggal_lahir": "1995-04-17",
  "tempat_lahir": "Lhokseumawe",
  "no_hp": "082345678901"
}
```
### Body untuk Obat ({{base_url}}/obat):
```
{
  "kode_obat": "OBT-9001",
  "nama_obat": "Paracetamol 500 mg",
  "stok": 120,
  "tanggal_kadaluarsa": "2028-12-31"
}
```
Header wajib: `Accept: application/json`.
Import `postman/API_Apotek.postman_collection.json` dan `postman/Lokal_Apotek.postman_environment.json` ke Postman.

## Struktur singkat
- `app/Models` - Pelanggan, Staf, Obat
- `app/Http/Controllers` - controller web; `Api/` - controller API
- `app/Http/Requests` - validasi; `app/Http/Resources` - format JSON
- `database/migrations`, `factories`, `seeders`
- `resources/views` - tampilan Blade; `public/css`, `public/js`
- `routes/web.php`, `routes/api.php`
