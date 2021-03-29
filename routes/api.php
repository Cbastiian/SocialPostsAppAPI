<?php

use Illuminate\Support\Facades\Route;

//TODO logout, middleware 

Route::namespace('Api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login');
    });

    Route::prefix('user')->group(function () {
        Route::post('save', 'UserController@createUser');
    });
});
