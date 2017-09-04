<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\UserStatus;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('user_statuses'))
        {
            $userStatuses          = UserStatus::orderBy('name','ASC')->get();
            $selectUserStatuses    = array();
            $selectUserStatuses[0] = "Select Status";

            foreach ($userStatuses as $userStatus) {
                $selectUserStatuses[$userStatus->id] = $userStatus->name;
            }

            \View::share('selectUserStatuses',$selectUserStatuses);

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
