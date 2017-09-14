<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewUser;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    public function index()

    {
        return view('auth.login');
    }

    public function show()
    {

        $NewUser = NewUser::where('active', 2)->get();// inactive users
        $activeUsers = NewUser::where('active', 1)->get(); //active users
        return view('users.list')->with(compact('NewUser', 'activeUsers'));
    }


//    public  function users()
//    {
//        $NewUser     =  NewUser::where('active',1)->get();// inactive users
//        $activeUsers =  NewUser::where('active',2)->get(); //active users
//        return  view ('users.list')->with(compact('NewUser','activeUsers'));
//    }


public function  InactiveusersLis()
{
    //$NewUser = NewUser::where('active', 1)->get();// inactive users

    $NewUser = \DB::table('new_users')
        ->join('user_roles', 'new_users.intrest', '=', 'user_roles.id')
     //   ->join('packagings', 'sellers_details_tabs.packaging', '=', 'packagings.id')
        ->select(\DB::raw
                           (
                                   "
                                    new_users.id,
                                    new_users.name,
                                    new_users.surname,
                                    new_users.email,
                                    user_roles.name  as intrest,
                                    new_users.location,
                                    new_users.travelRadius,
                                    new_users.cellphone,
                                    new_users.descriptionOfAcces
                                    
                                    "
     )
        )->where('active',1);


    return Datatables::of($NewUser)
        ->addColumn('actions','Edit')
        ->make(true);


}


    public function register()
    {
        return view('admin.register');
    }


    public function createUser()
    {
        return view('admin.register');
    }

    public function changePassword()
    {
        return view('emails.changePassword');
    }

}

