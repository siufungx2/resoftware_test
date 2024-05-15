<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\IUserServices;
use App\Services\UserServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserServices::class, UserServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
