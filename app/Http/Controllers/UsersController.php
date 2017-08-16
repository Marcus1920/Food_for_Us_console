<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewUser  ;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{


    public  function  index () {

        $userList  =  NewUser::all () ;
        return  response()->json($userList) ;
    }


    public  function   create  ()   {


        $name                   =  Input::get('name') ;
        $surname                =  Input::get('surname') ;
        $email                  =  Input::get('emails') ;
        $intrest                =  Input::get('intrest') ;
        $location               =  Input::get('location') ;
        $travel_radius          =  Input::get('travel_radius') ;
        $description_of_acces   =  Input::get('description_of_acces');

        $NewUser    =   new   NewUser  () ;
        $NewUser->  name                 = $name ;
        $NewUser->  email                = $email ;
        $NewUser->  intrest              = $intrest;
        $NewUser->  surname              = $surname ;
        $NewUser->  location             = $location;
        $NewUser->  travel_radius        =  $travel_radius ;
        $NewUser->  password        =   "1234" ;
        $NewUser->  description_of_acces  = $description_of_acces ;
        $NewUser-> save() ;

         $respose =  array() ;
         $respose['mesg']   =  "successfully registered  wait  for  approval " ;
        return  response()->json($respose);



    }
}
