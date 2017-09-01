<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\UserStatus;

class UserStatusSeeder extends Seeder
{
    public function run()
    {
        //DB::table('user_statuses')->truncate();
        UserStatus::create(['id' => '1','name' => 'active','slug' => 'active','active'=>'1']);
        UserStatus::create(['id' => '2','name' => 'pre-reg','slug' => 'pre-reg','active'=>'1']);
    }

}
