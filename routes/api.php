<?php

use App\Http\Controllers\Api\ContatoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;

// ROTAS PÚBLICAS

// Rotas para autenticação
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rota pública para contato
Route::post('/contacts', [ContatoController::class, 'store']);

// Rotas protegidas
Route::group(['middleware' => ['auth:sanctum']], function () {

    // Crud Usuários
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});
