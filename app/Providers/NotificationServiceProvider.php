<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\NotificationService;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NotificationService::class ,function($app)
        {
            return new NotificationService(
                $app->make('App\Services\NotificationService')
            );
        });
    }
}
