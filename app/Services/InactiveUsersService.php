<?php


namespace App\Services;
use App\NewUser;
use Carbon\Carbon;

class InactiveUsersService
{

    public function inactiveUsers()
    {
        $current   = Carbon::now();
        $twoDays   = 172800; // two days in seconds
        $users     = NewUser::where('active',2)->get();

        for($i=0;$i<count($users) ;$i++)
               {
                   $created_at = $users[$i]->created_at;
                   $diff       =  abs(strtotime($created_at) - strtotime($current));

                   if($diff > $twoDays)
                   {
                       $update = NewUser::where('id', $users[$i]->id)
                                          ->update(['active'=>1]);
                   }

               }
    }
}