# Cara menggunakan
1. Install Xampp untuk windows / mac https://www.apachefriends.org/index.html
2. Install composer https://getcomposer.org/Composer-Setup.exe
3. Download project ini https://github.com/NoitaminAoki/prototype-littemojo/archive/main.zip
4. Extract project, kemudian buka CMD dan masuk ke folder project tersebut
5. Jalankan `composer install` 
6. Rename file `.env.example` menjadi `.env`
7. Jalankan `php artisan key:generate`
8. Buat database bernama `littlemonjo` di http://localhost/phpmyadmin/index.php (buka di browser)
9. Lihat cmd kembali, jalankan `php artisan migrate --seed`
10. Jalankan `php artisan serve` dan buka `http://localhost:8000` di browser

## Dashboard
Admin : http://localhost:8000/admin/management/dashboard
Partner: http://localhost:8000/partner/management/dashboard
Customer : http://localhost:8000/dashboard
