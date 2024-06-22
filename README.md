# Project for managing gynecology clinics
# GynoCare - Project for managing gynecology clinics

### Packet manager: Composer
### PHP framework: Laravel 

### PHP version 8.0.13
### Installation:
#### Install dependencies with composer:
composer install
#### If there are php.ini errors(mostly related to external drivers):
composer install --ignore-platform-req=ext-fileinfo
#### Configure the .env file
#### Generate an application key:
php artisan key:generate
#### Run the database migrations:
#### Run the database migrations(mysql database connection required):
php artisan migrate
#### Run the database seeds:
php artisan db:seed
#### Link local storage
rm -R public/storage; 
php artisan storage:link
#### Run the local server
php artisan serve