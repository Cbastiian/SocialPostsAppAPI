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
            Route::post('follow-user', 'UserController@followUser');
            Route::post('unfollow-user', 'UserController@unfollowUser');
            Route::get('get-followings', 'UserController@getFollowers');
        });

        Route::prefix('post')->group(function () {
            Route::post('save', 'PostController@savePost');
            Route::get('get', 'PostController@getPosts');
            Route::put('change-status/{postId}', 'PostController@changePostStatus');
        });

        Route::prefix('comment')->group(function () {
            Route::post('save', 'CommentController@saveComment');
            Route::put('change-status/{commentId}', 'CommentController@changeCommentStatus');
        });

        Route::prefix('like')->group(function () {
            Route::post('toggle', 'LikeController@toggleLike');
        });

        Route::prefix('report')->group(function () {
            Route::post('save', 'ReportController@saveReport');
            Route::get('get/{reportElementType}', 'ReportController@getReports');
        });

        Route::prefix('product')->group(function () {
            Route::post('save', 'ProductController@saveProduct');
            Route::put('update/{productId}', 'ProductController@updateProduct');
            Route::put('change-status/{productId}', 'ProductController@changerProductStatus');
            Route::post('change-image/{productId}', 'ProductController@changeProductImage');
            Route::get('list-general', 'ProductController@getGeneralProducts');
            Route::get('get-by-user/{username}', 'ProductController@getProductsByUser');
            Route::get('get-by-code/{productCode}', 'ProductController@getProductByCode');
            Route::get('get-by-coincidence', 'ProductController@findProductsByTitle');
            Route::post('save-rating', 'ProductController@saveRating');
            Route::put('update-rating/{productId}', 'ProductController@updateRating');
        });
    });
});
//!Corregir sistema de login
//!Validar cambio de estado de post y comentario(propiedad del registro)
//TODO: conteo de productos
//TODO: incluir sistema de productos favoritos
//TODO: incluir sistema de rating de productos
//TODO: completar reporte de producto
