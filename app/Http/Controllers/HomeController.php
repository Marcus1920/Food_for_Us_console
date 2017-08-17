<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewUser  ;

class HomeController extends Controller
{
    public  function   index ()

    {


       $NewUser  =  NewUser::all() ;



       return  view ('welcome')->with(compact('NewUser'));

    }
}
