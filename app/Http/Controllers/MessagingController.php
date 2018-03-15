<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\MessagingNotification;
use App\Group;
use App\UserGroup;
use App\NewUser;
use App\Services\NotificationService;

class MessagingController extends Controller
{
    public function index()
    {

    }
    public function sendToGroup($id)
    {
        $group = Group::where('id',$id)->first();
        return view('MessagingNotification.create',compact('group'));
    }

    public function groupMessageCreate(Request $request)
    {
        $message = $request->message;

        $group = Group::where('id',$request->group_id)->first();

        $groupUsers = UserGroup::where('group_id',$group->id)->get();

        for($i=0 ; $i < count($groupUsers) ; $i++)
        {
            $oneUser = NewUser::where('id',$groupUsers[$i]->new_user_id)->first();

            $PlayerId = $oneUser->playerID;

            $newNotification = new NotificationService();
            $newNotification->sendToOne($message,$PlayerId);

            $notificationMessage              = new MessagingNotification();
            $notificationMessage->new_user_id = $oneUser->id;
            $notificationMessage->Message     = $message;
            $notificationMessage->save();
        }

        return Redirect('/group');
    }
}
