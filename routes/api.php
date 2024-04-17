<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/users', [UserController::class, 'getUsers']); // [Controller, método encargado de procesar este tipo de solicitudes]

// Paso de parametros por la url
Route::get('/users/{id}', [UserController::class, 'getUser']);

Route::post('/users', [UserController::class, 'saveUser']);

Route::put('/users/{id}', [UserController::class, 'updateUser']);

Route::patch('/users/{id}', [UserController::class, 'updatePartialUser']);

Route::delete('/users/{id}', [UserController::class, 'deleteUser']);