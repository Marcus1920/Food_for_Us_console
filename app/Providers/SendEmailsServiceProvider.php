<?php

namespace App\Providers;

use App\Services\EmailService;
use Illuminate\Support\ServiceProvider;

class SendEmailsServiceProvider extends ServiceProvider
{

    public function boot()
    {
    }


    public function register()
    {
        $this->app->bind(EmailService::class,function($app){
            return new EmailService(
                $app->make('App\Services\EmailService')
            );
        });
    }
}
