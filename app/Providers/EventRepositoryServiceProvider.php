<?php

namespace App\Providers;

use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\EventRepository;
use Illuminate\Support\ServiceProvider;

class EventRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            EventRepositoryInterface::class,
            EventRepository::class
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
