## Instalar dependencias del proyecto
    composer install --ignore-platform-reqs

    php artisan key:generate --ansi

## Crea la Base de datos SQLite
    php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');" 

## Realiza la migración inicial

    php artisan migrate --graceful --ansi

## Iniciar el proyecto

    php artisan serve  

Problemas de la migración:

[Stack OverFlow Solution](https://stackoverflow.com/questions/64381185/laravel-and-phpunit-could-not-find-driver-sql-pragma-foreign-keys-on)

Windows:

For those using windows;

Navigate to the php.ini file(-C:\php\php.ini)

Enable the following:

;extension=pdo_sqlite by removing the /;/ should look like this extension=pdo_sqlite

;extension=sqlite3 should be extension=sqlite3 without the ; symbol

Linux: 
sudo apt-get install php-sqlite3

## Posibles problemas

sudo apt-get install php8.3-dom

sudo apt-get install php8.3-mysql