
Movie World is a Laravel-based web app where users can add movies, like or hate them, and see vote counts in real-time.

## Setup Instructions

1. Clone the repository  
   `git clone https://github.com/fanis-kol/movie-world`

2. Navigate to the project directory  
   `cd movie-world`

3. Install PHP dependencies  
   `composer install`

4. Install JavaScript dependencies  
   `npm install`

5. Build frontend assets  
   `npm run build`

6. Set up your `.env` file with the correct database configuration

7. Generate the application key  
   `php artisan key:generate`

8. Run migrations and seed the database  
   `php artisan migrate --seed`

9. Serve the application  
   `php artisan serve`
