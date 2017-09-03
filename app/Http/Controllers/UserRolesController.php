<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRoles;
use Illuminate\Support\Facades\Input;

class UserRolesController extends Controller
{
    public function index()
    {
        $userRoles=UserRoles::all();
        return view('UserRoles.index', compact('userRoles'));
    }
    public function create(Request $request)
    {
        $newRole = new UserRoles();
        $newRole->name = $request['name'];
        $newRole->slug = $request['name'];
        $newRole->save();
    }


    public function getUserRoles()
    {

        $userRoles  =   UserRoles::select('id','name')->get();
        return response()->json($userRoles);

    }
}
