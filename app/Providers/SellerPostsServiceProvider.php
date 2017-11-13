<?php

namespace App\Providers;

use App\Services\SellerPostsService;
use Illuminate\Support\ServiceProvider;

class SellerPostsServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
      $this->app->bind(SellerPostsService::class ,function($app)
      {
          return new SellerPostsService();
      });
    }
}
