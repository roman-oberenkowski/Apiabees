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

## Screenshots
`all names in screenshots are fake (generated with php faker library)`
![newAction](https://github.com/roman-oberenkowski/Apiabees/blob/f5b27e81e3669e2009c34550aa84a709dad8777a/readme_resources/newAction.jpg)
![specieList](https://github.com/roman-oberenkowski/Apiabees/blob/f5b27e81e3669e2009c34550aa84a709dad8777a/readme_resources/SpeciesList.jpg)
![empEdit](https://github.com/roman-oberenkowski/Apiabees/blob/f5b27e81e3669e2009c34550aa84a709dad8777a/readme_resources/EmployeeEdit.jpg)
![attencance](https://github.com/roman-oberenkowski/Apiabees/blob/f5b27e81e3669e2009c34550aa84a709dad8777a/readme_resources/Attendance.jpg)

## DB stuff

![relschema](https://github.com/roman-oberenkowski/Apiabees/blob/f5b27e81e3669e2009c34550aa84a709dad8777a/readme_resources/Relational%20schema.png)
![entschema](https://github.com/roman-oberenkowski/Apiabees/blob/f5b27e81e3669e2009c34550aa84a709dad8777a/readme_resources/Entity%20schema.png)
