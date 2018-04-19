<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValidationRequest;
use Illuminate\Http\Request;

use App\User;
use App\NewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Yajra\DataTables\DataTables;

class MyRegisterController extends Controller
{
    //



    public function createAdmin(CreateValidationRequest $request)
    {



        $adminUsers                 = new User();
        $adminUsers->name           = $request['name'];
        $adminUsers->surname        = $request['surname'];
        $adminUsers->gender         = $request['gender'];
        $adminUsers->cellphone      = $request['code'].$request['cellphone'];
        $adminUsers->email          = $request['email'];
        $adminUsers->password       = bcrypt($request['password']);
        $adminUsers->created_by     = Auth::user()->name . ' ' . Auth::user()->surname  ;
        $adminUsers->remember_token = $request['_token'];
        $adminUsers->save();
        return Redirect::to('/users');
    }

    public function  adminUsers()
    {
        return view('users.adminUsers');
    }

    public function getAdminUsers()
    {
        $adminUsers = User::all();

        return Datatables::of($adminUsers)
            ->make(true);
    }
}
