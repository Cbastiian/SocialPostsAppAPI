<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::prefix('test')->group(function () {
        Route::post('try', 'TestController@test');
    });
});
