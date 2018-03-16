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

    public function sendToUsers()
    {
        return view('MessagingNotification.createUsers');
    }

    public function usersMessageCreate(Request $request)
    {
        $Users=explode(",",$request->Users);

        $message = $request->message;

        for($i=0 ; $i < count($Users) ; $i++)
        {
            $oneUser = NewUser::where('id',$Users[$i])->first();

            $PlayerId = $oneUser->playerID;

            $newNotification = new NotificationService();
            $newNotification->sendToOne($message,$PlayerId);

            $notificationMessage              = new MessagingNotification();
            $notificationMessage->new_user_id = $oneUser->id;
            $notificationMessage->Message     = $message;
            $notificationMessage->save();
        }
        return Redirect('/msgUsers');
    }

    public function AllmessageNotification()
    {
        $notifications = \DB::table('messaging_notifications')
            ->join('new_users', 'messaging_notifications.new_user_id', '=', 'new_users.id')
            ->select(
                \DB::raw("
                                           messaging_notifications.id,
                                           messaging_notifications.message as message,
                                           new_users.name as name,
                                           new_users.surname as surname 
                                         
                                         
                         ")

            )
            ->get();

        return view('MessagingNotification.messageNotification', compact('notifications'));

    }

    public function resendMessageNotification($id)
    {
        $notification = MessagingNotification::where('id', $id)->first();
        return view('MessagingNotification.resendMessageNotification', compact('notification'));

    }
}
