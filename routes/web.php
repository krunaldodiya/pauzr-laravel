<?php

use App\Http\Controllers\TestController;

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');

Route::group(['prefix' => 'test', 'middleware' => 'auth'], function () {
    Route::get('test', [TestController::class, 'web']);
    Route::get('env', [TestController::class, 'env']);
});
