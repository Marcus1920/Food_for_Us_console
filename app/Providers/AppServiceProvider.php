<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\UserStatus;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{

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
        Schema::defaultStringLength(191);
    }

    public function register()
    {

    }
}
