<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::post('/user', [UserController::class, 'createUser']);
    Route::get('/users', [UserController::class, 'getUserList']);
    Route::get('/user/{id}', [UserController::class, 'getUserDetails'])->where('id', '[0-9]+');
    Route::put('/user/{id}', [UserController::class, 'updateUser'])->where('id', '[0-9]+');
    Route::delete('/user/{id}', [UserController::class, 'getUserDetails'])->where('id', '[0-9]+');
});
