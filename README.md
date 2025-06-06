
Movie World is a Laravel-based web app where users can add movies, like or hate them, and see vote counts in real-time.


Setup Instructions
-------------------
clone the repository.
cd movie-world.
composer install.
npm install.
npm run build.
Set your database in .env:
php artisan key:generate.
php artisan migrate --seed.
php artisan serve.

