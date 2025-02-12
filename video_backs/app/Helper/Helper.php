<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/*
 *  this is for crate token users
 */
if (!function_exists('TokeRegisterNew')) {
    /**
     * @return string
     */
    function TokeRegisterNew(): string
    {
        return str_replace('-', '', Str::uuid() . time());

    }
}

if (!function_exists('generateCodeRandom')) {

    function generateCodeRandom(): string
    {
        return str_pad(strval(random_int(0, 999999)), 6, '0', STR_PAD_LEFT);
    }
}




if (!function_exists('LogError')) {

    function LogError($errors): null
    {
       return   Log::channel('custom_error')->error($errors);
    }
}


