<?php

namespace App\Providers;

use App\servers\sms\adapter\Kavenegars\Kavenegar;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\servers\sms\SmsInterface;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SmsInterface::class, Kavenegar::class );
    }



    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->routeRegister();
    }

    protected function routeRegister(): void
    {
        Route::prefix('api/v1')
            ->group(__DIR__ . '/../../routes/api.php');
    }
}
