<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TransactionController;

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'getUsers']); // [Controller, método encargado de procesar este tipo de solicitudes]
    // Paso de parametros por la url
    Route::get('/{id}', [UserController::class, 'getUser']);
    Route::post('/', [UserController::class, 'saveUser']);
    Route::put('/{id}', [UserController::class, 'updateUser']);
    Route::patch('/{id}', [UserController::class, 'updatePartialUser']);
    Route::delete('/{id}', [UserController::class, 'deleteUser']);
});

Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'getTransactions']); // [Controller, método encargado de procesar este tipo de solicitudes]
    // Paso de parametros por la url
    // Route::get('/{id}', [TransactionController::class, 'getUser']);
    Route::post('/', [TransactionController::class, 'createTransaction']);
    /* Route::put('/{id}', [TransactionController::class, 'updateUser']);
    Route::patch('/{id}', [TransactionController::class, 'updatePartialUser']);
    Route::delete('/{id}', [TransactionController::class, 'deleteUser']); */
});
