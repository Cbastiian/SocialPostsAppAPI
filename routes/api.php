<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login');
    });

    Route::prefix('user')->group(function () {
        Route::post('validate', 'UserController@validateUser');
        Route::post('resend-verification-email', 'UserController@resendVerificationEmail');
    });

    Route::group(['middleware' => 'jwt.verify'], function () {
        Route::prefix('auth')->group(function () {
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::post('me', 'AuthController@me');
        });
    });

    Route::prefix('user')->group(function () {
        Route::post('save', 'UserController@createUser');
    });
});
