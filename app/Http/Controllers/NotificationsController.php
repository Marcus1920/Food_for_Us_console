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

    public function getAllNotification()
    {
        $notifications=\DB::table('notifications')
            ->join('new_users','notifications.new_user_id','=','new_users.id')
            ->select(
                \DB::raw("
                                           new_users.id,
                                           notifications.PostId,
                                           notifications.ProductName,
                                           notifications.Message,
                                           new_users.name as name,
                                           new_users.surname as surname 
                                         
                                         
                         ")

            )
            ->get();

        return view('Notification.index', compact('notifications'));
    }

    public function resendNotification($id)
    {
        $notification = Notification::where('id',$id)->first();
        return view( 'Notification.resend',compact('notification'));
    }
}
