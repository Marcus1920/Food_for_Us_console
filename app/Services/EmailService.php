<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/4/2017
 * Time: 3:04 PM
 */

namespace App\Services;

use App\NewUser;

class EmailService
{
    public  function Buyers()
    {
        $buyerDetails     = NewUser::where('intrest','=',1)->get();
        foreach($buyerDetails as $buyerDetail)
        {
            return  $buyerDetail->email;
        }

    }

}