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
        return view('users.active');
    }


    public function  InactiveusersLis()
        {

            $NewUser = \DB::table('new_users')
                ->where('new_users.active','=',1)
                ->join('user_roles', 'new_users.intrest', '=', 'user_roles.id')
                ->join('user_travel_radii','new_users.travelRadius','=','user_travel_radii.id')
                ->select(\DB::raw
                                   (
                                           "
                                            new_users.id,
                                            new_users.name,
                                            new_users.surname,
                                            new_users.cellphone,
                                            new_users.email,
                                            new_users.cellphone,
                                            user_roles.name  as intrest,
                                            new_users.location,
                                            user_travel_radii.kilometres as travelRadius,
                                            new_users.cellphone,
                                            new_users.descriptionOfAcces,
                                            new_users.created_at
                                            
                                            "
             )
                );


            return Datatables::of($NewUser)
                ->make(true);

               }
    public function  activeusersLis()
    {

        $activeUsers = \DB::table('new_users')
            ->where('new_users.active','=',2)
            ->join('user_roles', 'new_users.intrest', '=', 'user_roles.id')
            ->join('user_travel_radii','new_users.travelRadius','=','user_travel_radii.id')
            ->select(\DB::raw(
                "
                                    new_users.id,
                                    new_users.name,
                                    new_users.surname,
                                    new_users.cellphone,
                                    new_users.email,
                                    new_users.cellphone,
                                    user_roles.name  as intrest,
                                    new_users.location,
                                    user_travel_radii.kilometres as travelRadius,
                                    new_users.cellphone,
                                    new_users.descriptionOfAcces,
                                    new_users.created_at,
                                    new_users.gps_lat,
                                    new_users.gps_long,
                                    new_users.last_login
                                   
                                    
                                    "
            )
            );


        return Datatables::of($activeUsers)
            ->make(true);


    }
    public function  deactivatedusersList()
    {

        $deactivated = \DB::table('new_users')
            ->where('new_users.active','=',3)
            ->join('user_roles', 'new_users.intrest', '=', 'user_roles.id')
            ->join('user_travel_radii','new_users.travelRadius','=','user_travel_radii.id')
            ->select(\DB::raw(
                "
                                    new_users.id,
                                    new_users.name,
                                    new_users.surname,
                                    new_users.cellphone,
                                    new_users.email,
                                    user_roles.name  as intrest,
                                    new_users.location,
                                    user_travel_radii.kilometres as travelRadius,
                                    new_users.cellphone,
                                    new_users.descriptionOfAcces,
                                    new_users.created_at,
                                    new_users.gps_lat,
                                    new_users.gps_long
                                    
                                    "
            )
            );

//        return $deactivated;


        return Datatables::of($deactivated)
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

