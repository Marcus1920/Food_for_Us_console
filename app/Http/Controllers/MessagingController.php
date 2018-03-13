<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;


class MessagingController extends Controller
{
    public function index()
    {
        $notifications = Notification::select('id','PostId','ProductName','Message','Status','created_at')
            ->whereDate('created_at', '=', \Carbon\Carbon::now('Africa/Johannesburg')->toDateString())
            ->orderBy('id','ASC')-> get();
        return response()->json($notifications);
    }

}
