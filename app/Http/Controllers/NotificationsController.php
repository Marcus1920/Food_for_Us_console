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

        $notifications=\DB::table('notifications')
            ->join('sellers_details_tabs', 'notifications.PostId', '=', 'sellers_details_tabs.id')
            ->where('notifications.new_user_id',$user->id)
            ->where('notifications.Status',0)
            ->select(
                \DB::raw(
                    "
                        notifications.id,
                        notifications.new_user_id,
                        notifications.PostId,
                        sellers_details_tabs.productPicture,
                        notifications.ProductName,
                        notifications.Message,
                        notifications.Status,
                        notifications.created_at
                    "
                )
            )
            ->orderBy('id','ASC')
            ->get();

        return response()->json($notifications);
    }
}
