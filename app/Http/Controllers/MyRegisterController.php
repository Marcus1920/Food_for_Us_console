<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\NewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class MyRegisterController extends Controller
{
    //



    public function createAdmin(Request $request)
    {




        $adminUsers                 = new User();
        $adminUsers->name           = $request['name'];
        $adminUsers->surname        = $request['surname'];
        $adminUsers->gender         = $request['gender'];
        $adminUsers->cellphone      = $request['cellphone'];
        $adminUsers->email          = $request['email'];
        $adminUsers->password       =  bcrypt($request['password']);
//       $adminUsers->created_by   =  \Auth::user()->name;
        $adminUsers->remember_token = $request['_token'];
        $adminUsers->save();
        return Redirect::to('/users');


    }

    public function  adminUsers()
    {
        $adminUsers  =  User::all () ;
        return view('users.adminUsers', compact('adminUsers'));
        //return  response()->json($adminUsers);
    }
}
