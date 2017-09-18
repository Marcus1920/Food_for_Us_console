<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\transactionService;

class TransactionServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }


    public function register()
    {
        $this->app->bind(transactionService::class,function($app){
            return new transactionService(
                $app->make('App\Services\transactionService')
            );
        });
    }
}
