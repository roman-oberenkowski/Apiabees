# Apiabees
Project for Database Management classes.

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
10. Create database named `apiabees`,
11. `php artisan migrate:fresh --seed`,
12. `php artisan serve`,
13. Voila
