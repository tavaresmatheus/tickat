<?php

namespace App\Providers;

use App\Businesses\Contracts\UserBusinessInterface;
use App\Businesses\UserBusiness;
use Illuminate\Support\ServiceProvider;

class UserBusinessServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserBusinessInterface::class,
            UserBusiness::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
