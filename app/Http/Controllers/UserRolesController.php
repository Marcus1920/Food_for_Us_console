<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRoles;
use App\NewUser;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class UserRolesController extends Controller
{
    public function index()
    {
        return view('UserRoles.index');
    }
    public function getAllUserRoles()
    {
        $userRoles = \DB::table('user_roles')->orderBy('name')
            ->select(\DB::raw
            (
                "
                    user_roles.id,
                    user_roles.name
                                     
                "
            )
            );

        return Datatables::of($userRoles)
            ->make(true);
    }

    public function getUsersView($id)
    {
        $userRole = UserRoles::find($id);
        return view('UserRoles.usersPerGroup',compact('userRole'));
    }

    public function getUserByUserRole($id)
    {
//        $users = NewUser::where('intrest',$id)->get();

        $users = \DB::table('new_users')
            ->where('new_users.intrest','=',$id)
            ->join('user_roles', 'new_users.intrest', '=', 'user_roles.id')
            ->join('user_travel_radii','new_users.travelRadius','=','user_travel_radii.id')
            ->select(\DB::raw(
                "
                                    new_users.id,
                                    new_users.name,
                                    new_users.surname,
                                    new_users.email,
                                    user_roles.name  as intrest,
                                    new_users.location,
                                    user_travel_radii.kilometres as travelRadius,
                                    new_users.cellphone,
                                    new_users.descriptionOfAcces
                                    
                                    "
            )
            );

        return Datatables::of($users)
            ->make(true);
    }

    public function store(Request $request)
    {

        $this->validate($request,[

            'name'=>'required|alpha',

            ]);

        $lastUserRole=UserRoles::all()->last();
        $markerNum = $lastUserRole->id + 1;

        $newRole = new UserRoles();
        $newRole->name = $request['name'];
        $newRole->slug = $request['name'];
        $newRole->marker_url = "img/Markers/$markerNum.png";
        $newRole->save();

        return Redirect('/userroleslist');
    }


    public function getUserRoles()
    {

        $userRoles  =   UserRoles::select('id','name')->get();
        return response()->json($userRoles);

    }
    public function editUserRole($id)
    {
        $userRole = UserRoles::find($id);

        return view('UserRoles.edit',compact('userRole'));

//        return Redirect('/userroleslist');
    }
    public function update(Request $request)
    {
        UserRoles::where('id',$request['id'])
            ->update(['name'=>$request['userRoleName'],
                'slug'=>$request['userRoleName']]);

        return Redirect('/userroleslist');
    }

}
