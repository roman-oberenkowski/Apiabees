
# Apiabees
Project from Database Management.

## Requirements
* composer
* npm

## Installation 
To install the app follow these steps: 
1. Download/clone the repo,
2. Open terminal and go to your project folder, 
3. Type in `composer install`,
4. `npm install`,
5. `npm run dev`,
6. `sudo chmod -R 777 storage/`,
7. `sudo chmod -R 777 bootstrap/cache`,
8. copy .env.example to .env and fill it with data you'll need (database, mail),
9. `php artisan key:generate`,
10. Import database from `Database.sql` (stored procedures import separately) and `php artisan migrate --seed` (in order)
11. `php artisan serve`
12. Voila
