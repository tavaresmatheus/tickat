<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'return-json'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get(
            '/users',
            'listAllUsers'
        );

        Route::get(
            '/users/{id}',
            'findUser'
        )->whereUuid('id');

        Route::delete(
            '/users/{id}',
            'deleteUser'
        )->whereUuid('id');

        Route::put(
            '/users/{id}',
            'updateUser'
        )->whereUuid('id');
    });

    Route::controller(EventController::class)->group(function () {
        Route::get(
            '/events',
            'listAllEvents'
        );

        Route::post(
            '/events',
            'createEvent'
        );
    });

    Route::controller(AuthController::class)->group(function () {
        Route::post(
            'auth/logout',
            'logout'
        );
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::post(
        'auth/login',
        'login'
    );

    Route::post(
        'auth/register',
        'register'
    );
});
