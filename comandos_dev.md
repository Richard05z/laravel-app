php artisan install:api // Crea una API

php artisan make:migration {create_user_table} // El nombre de la tabla sera la palabra del centro (user)

php artisan migrate // Crea o actualiza las tablas de la bd del proyecto segun la estructura definida en la migración

php artisan make:model User // Crea un Model

php artisan make:migration modify_column_type_{table_name}_{column_name} // Modificar el tipo de dato de un campo de una tabla ya creada

Luego en el método up() usar: 

Schema::table('users', function (Blueprint $table) {
    $table->integer('age')->change('bigInteger');
});