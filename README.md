# Transactions-Filament

A simple money management system that tracks deposits and debits.

### Development Environment Installation Instructions

1. After cloning this repository change to the project's directory and run the following command: ```composer install```
2. Next run the ```npm install``` command.
3. Run the ```npm run build``` command.
4. Create a new ```.env``` from the provided ```.env.example``` file by running: 
```shell
cp .env.example .env
```
5. Run the following command to generate an application key and add it to the ```.env``` file:
```shell
php artisan key:generate
```
6. If you are using the default SQLite database just run the command
```shell
php artisan migrate
```
Otherwise make the appropriate changes to the database environment variables in the ```.env``` file then run the command above.
7. 
