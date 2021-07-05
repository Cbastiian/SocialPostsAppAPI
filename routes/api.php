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
            Route::get('me', 'AuthController@me');
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
        });

        Route::prefix('user')->group(function () {
            Route::get('get-followings', 'UserController@getFollowers');
            Route::post('update-bio', 'UserController@updateBio');
            Route::post('update-profile-photo', 'UserController@updatProfilePhoto');
            Route::post('follow-user', 'UserController@followUser');
            Route::post('unfollow-user', 'UserController@unfollowUser');
        });

        Route::prefix('post')->group(function () {
            Route::get('get', 'PostController@getPosts');
            Route::post('save', 'PostController@savePost');
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
            Route::get('get/{reportElementType}', 'ReportController@getReports');
            Route::post('save', 'ReportController@saveReport');
        });

        Route::prefix('product')->group(function () {
            Route::get('list-general', 'ProductController@getGeneralProducts');
            Route::get('get-by-user/{username}', 'ProductController@getProductsByUser');
            Route::get('get-by-code/{productCode}', 'ProductController@getProductByCode');
            Route::get('get-by-coincidence', 'ProductController@findProductsByTitle');
            Route::get('get-favorite', 'ProductController@getFavoriteProducts');
            Route::get('get-count/{userId}', 'ProductController@getProductCount');
            Route::post('save', 'ProductController@saveProduct');
            Route::post('change-image/{productId}', 'ProductController@changeProductImage');
            Route::post('save-rating', 'ProductController@saveRating');
            Route::post('save-favorite/{productId}', 'ProductController@saveFavorite');
            Route::put('update-rating/{productId}', 'ProductController@updateRating');
            Route::put('update/{productId}', 'ProductController@updateProduct');
            Route::put('change-status/{productId}', 'ProductController@changerProductStatus');
            Route::delete('remove-favorite/{productId}', 'ProductController@removeFavorite');
        });

        Route::prefix('history')->group(function () {
            Route::post('save', 'HistoryController@saveHistory');
            Route::put('change-status/{historyId}', 'HistoryController@changeHistoryStatus');
        });
    });
});
//TODO: consulta de historias de usurio seguidos
//TODO: actualizacion de datos de usurio
