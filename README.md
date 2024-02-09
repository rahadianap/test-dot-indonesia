# Initial Setup

## 1. Clone repository
Launch a cmd and clone the project.

`git clone https://github.com/rahadianap/test-dot-indonesia.git`

## 2. Lakukan perintah cd ke dalam folder.

`cd test-dot-indonesia`

## 3. Install composer dependencies.

`composer install`

## 4. Install NPM dependencies.

`npm install`

## 5. Copy .env file
Copy file .env.example dan rename menjadi .env.

`cp .env.example .env`

## 6. Generate app encryption key
Jalankan perintah berikut untuk generate encryption key.

`php artisan key:generate`

## 7. Buat sebuah database baru untuk menyimpan data.

## 8. Konfigurasi .env.
Konfigurasi .env file yang sudah dibuat tadi, masukkan pengaturan database sesuai dengan yang sudah dibuat.

## 10. Database migration.
Jalankan perintah berikut untuk menjalankan migration (create table).

`php artisan migrate`

## 11. Jalankan server
Untuk menjalankan service, cukup ketikkan perintah berikut.

`php artisan serve`

## 12. Fetch data dan insert ke database
Jalankan perintah berikut untuk fetch data dari `https://rajaongkir.com/dokumentasi/starter` dan insert data ke database.

`php artisan fetch-store:provinces`

`php artisan fetch-store:cities`

# Testing Web Service

## 1. Alur testing web service

### 1.1 Akses data
Untuk mengetahui apakah aplikasi berhasil dijalankan, coba paste url berikut ke postman. Jangan lupa untuk menambahkan query parameter id.

`http://localhost:8000/api/search/provinces?id=1`

![alt text](https://github.com/rahadianap/test-dot-indonesia/blob/sprint1/Screenshot.png?raw=true)

Jika berhasil, response yang didapat sebagai berikut

```json
{
    "success": true,
    "message": "Data Retrieved Successfully",
    "data": {
        "province_id": "1",
        "province": "Bali"
    }
}
```

## 2. Route list
### 2.1 Pencarian Data Province dan City Berdasarkan id
```
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/search/provinces', [ProvinceController::class, 'searchProvince']);
    Route::get('/search/cities', [CityController::class, 'searchCity']);
});
```
