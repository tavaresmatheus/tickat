<?php

use App\Http\Controllers\AuthController;
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
    Route::get('/users', [UserController::class, 'listAllUsers']);

    Route::get('/users/{id}', [UserController::class, 'findUser'])->whereUuid('id');

    Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->whereUuid('id');

    Route::put('/users/{id}', [UserController::class, 'updateUser'])->whereUuid('id');
});

Route::post('auth/login', [AuthController::class, 'login']);

Route::post('auth/register', [AuthController::class, 'register']);
