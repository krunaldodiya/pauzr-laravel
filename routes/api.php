<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'test', 'middleware' => 'auth:api'], function () {
    Route::get('/test', [TestController::class, 'api']);
});

Route::group(['prefix' => 'location'], function () {
    Route::get("countries", [LocationController::class, 'getCountries']);
});

Route::group(['prefix' => 'otp', 'middleware' => 'guest:api'], function () {
    Route::post("request", [OtpController::class, 'requestOtp']);
    Route::post("verify", [OtpController::class, 'verifyOtp']);
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:api'], function () {
    Route::get("me", [UserController::class, 'me']);
});

Route::group(['prefix' => 'auth', 'middleware' => 'guest:api'], function () {
    Route::post("signup", [AuthController::class, 'signup']);
    Route::post("signin", [AuthController::class, 'signin']);
});

Route::group(['prefix' => 'attachments', 'middleware' => 'auth:api'], function () {
    Route::post("upload", [AttachmentController::class, 'upload']);
});
