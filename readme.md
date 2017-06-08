#Panduan Instalasi :
- Clone repository
jalankan perintah dibawah
- composer update
- cp .env.example .env
- php artisan key:generate
- php artisan migrate --seed

Sesuaikan .env dengan environment yang digunakan (database, session, queue, etc)

