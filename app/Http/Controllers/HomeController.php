<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewUser;

class HomeController extends Controller
{
    public function index()

    {
        return view('auth.login');
    }

    public function show()
    {
        $NewUser = NewUser::where('active', 1)->get();// inactive users
        $activeUsers = NewUser::where('active', 2)->get(); //active users
        return view('users.list')->with(compact('NewUser', 'activeUsers'));
    }

//    public  function users()
//    {
//        $NewUser     =  NewUser::where('active',1)->get();// inactive users
//        $activeUsers =  NewUser::where('active',2)->get(); //active users
//        return  view ('users.list')->with(compact('NewUser','activeUsers'));
//    }

    public function register()
    {
        return view('admin.register');
    }


    public function createUser()
    {
        return view('admin.register');
    }


    public function updateUser($id)
    {


        $user = NewUser::where('id', $id)
            ->update(['active' => 2]);

        $userDetails = NewUser::find($id);

        $data = array(
            'name' => $userDetails->name,
            'message' => "",
            //'sender' =>\Auth::user()->name. ' '. \Auth::user()->surname,
        );

        \Mail::send('emails.registration', $data, function ($message) use ($userDetails) {

            $message->from('info@siyaleader.net', 'Siyaleader');
            $message->to($userDetails->email)->subject("Siyaleader Notification - Request for Case Closure: ");

        });
    }


}

