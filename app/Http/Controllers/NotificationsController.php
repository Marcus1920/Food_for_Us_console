<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Input;
use App\NewUser;

class NotificationsController extends Controller
{
    public function index()
    {
        $api_key   = Input::get('api_key');

        $user  = NewUser::where('api_key',$api_key)->first();

        $notifications = Notification::select('id','new_user_id','PostId','ProductName','Message','Status','created_at')
            ->where('new_user_id',$user->id)
            ->where('Status',0)
            ->orderBy('id','ASC')-> get();

        return response()->json($notifications);
    }
}
