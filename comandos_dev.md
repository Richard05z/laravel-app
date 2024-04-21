php artisan install:api // Crea una API

php artisan make:migration {create_user_table} // El nombre de la tabla sera la palabra del centro (user)

php artisan migrate // Crea o actualiza las tablas de la bd del proyecto segun la estructura definida en la migración

php artisan make:model User // Crea un Model

php artisan make:migration modify_column_type_{table_name}_{column_name} // Modificar el tipo de dato de un campo de una tabla ya creada

Luego en el método up() de la migración que se va a genrar: 

Schema::table('users', function (Blueprint $table) {
    $table->integer('age')->change('bigInteger');
});

php artisan make:migration add_column_{table_name}_{column_name} // Agregar una columna a una tabla ya existente

Luego en el método up() de la migración que se va a genrar: 

public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('phone_number')->nullable();
    });
}

Instalar cliente HTTP

composer require guzzlehttp/guzzle --ignore-platform-req=ext-curl