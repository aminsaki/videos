<?php

use App\Http\Logins\OtpController;
use \Illuminate\Support\Facades\Route;
use \App\Http\Controllers as Controllers;

Route::apiResource('loginOtp', OtpController::class);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('links', Controllers\LinkController::class);
    Route::apiResource('categories', Controllers\CategorieController::class);
});

Route::apiResource('videos', Controllers\videoController::class);
