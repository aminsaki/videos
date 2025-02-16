<?php

use App\Http\Logins\OtpController;
use \Illuminate\Support\Facades\Route;

Route::apiResource('loginOtp', OtpController::class);

