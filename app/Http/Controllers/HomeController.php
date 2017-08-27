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
        $NewUser     =  NewUser::where('active',1)->get();// inactive users
        $activeUsers =  NewUser::where('active',2)->get(); //active users
        return  view ('users.list')->with(compact('NewUser','activeUsers'));
    }

    public  function register()
    {
        return  view ('users.register');
    }


    public  function createUser()
    {
        return  view ('users.register');
    }
}
