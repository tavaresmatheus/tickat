<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'listAllUsers');

        Route::get('/users/{id}', 'findUser')->whereUuid('id');

        Route::delete('/users/{id}', 'deleteUser')->whereUuid('id');

        Route::put('/users/{id}', 'updateUser')->whereUuid('id');
    });

    Route::controller(EventController::class)->group(function () {
        Route::get('/events', 'index');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login');

    Route::post('auth/register', 'register');
});
