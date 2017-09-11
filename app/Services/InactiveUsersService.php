<?php


namespace App\Services;
use App\NewUser;

class InactiveUsersService
{

    public function inactiveUsers()
    {
        $users = NewUser::where('active',1)->get();
        return $users;
    }
}