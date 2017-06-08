#Panduan Instalasi :
- Clone repository
- composer update
- cp .env.example .env
- php artisan key:generate
- php artisan migrate --seed

Sesuaikan .env dengan environment yang digunakan (databse, session, queue, etc)

