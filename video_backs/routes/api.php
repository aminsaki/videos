<?php

use \Illuminate\Support\Facades\Route;


Route::apiResource('authentications', Controllers\OtpController::class)->middleware('phone.throttle:15,1');

