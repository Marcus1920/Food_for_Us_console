<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/18/2017
 * Time: 2:21 PM
 */

namespace App\Providers;


use App\Services\SellerService;
use Illuminate\Support\ServiceProvider;


class SellersServiceProvider extends ServiceProvider
{

    public function boot()
    {
    }


    public function register()
    {
        $this->app->bind(SellerService::class,function($app){
            return new SellerService(
                $app->make('App\Services\SellerService')
            );
        });
    }

}