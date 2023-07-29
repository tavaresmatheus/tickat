<?php

namespace App\Providers;

use App\Businesses\Contracts\EventBusinessInterface;
use App\Businesses\EventBusiness;
use Illuminate\Support\ServiceProvider;

class EventBusinessServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            EventBusinessInterface::class,
            EventBusiness::class
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
