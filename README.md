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
