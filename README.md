## Set ENV file
copy and rename the .env.example to .env
set the values of your local database to the following variables

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

## Command to run the migration
php artisan migrate:refresh --seed

## Command to Run Test
php artisan test

## Tool to Use
Download and install the postman app from https://www.postman.com/downloads/
Import the pokemon-app.postman_collection which contains the commands for CRUD.