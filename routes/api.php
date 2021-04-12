<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {

    Route::prefix('auth')->group(function () {

        Route::post('login', 'AuthController@login');
    });

    Route::prefix('user')->group(function () {

        Route::post('save', 'UserController@createUser');
        Route::post('validate', 'UserController@validateUser');
        Route::post('resend-verification-email', 'UserController@resendVerificationEmail');
        Route::post('reset-password-mail', 'UserController@sendResetPasswordMail');
        Route::post('reset-password', 'UserController@resetPassword');
    });

    Route::group(['middleware' => 'jwt.verify'], function () {

        Route::prefix('auth')->group(function () {

            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::post('me', 'AuthController@me');
        });

        Route::prefix('user')->group(function () {

            Route::post('update-bio', 'UserController@updateBio');
            Route::post('update-profile-photo', 'UserController@updatProfilePhoto');
        });

        Route::prefix('post')->group(function () {

            Route::post('save', 'PostController@savePost');
        });
    });
});
//TODO: implementacion de sistema de seguidores
//TODO: implementacion de sistema de comentarios de posts
