<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewUser  ;

class HomeController extends Controller
{
    public  function   index()

    {
        return view('auth.login');
    }

    public  function show()
{
    $NewUser  =  NewUser::all();
    return  view ('master')->with(compact('NewUser'));
}



    public  function users()
    {
        $NewUser  =  NewUser::all();
        return  view ('users.list')->with(compact('NewUser'));
    }

    public  function register()
    {
        return  view ('users.register');
    }
}
