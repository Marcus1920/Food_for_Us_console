<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\MessagingNotification;
use App\Group;
use App\UserGroup;
use App\NewUser;
use App\Services\NotificationService;
use Session;

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

        \Session::flash('success', 'well done! Message notification successfully sent to '.$group->name.' group!');
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

        \Session::flash('success', 'well done! Message notification successfully sent');
        return Redirect('/msgUsers');
    }

    public function resendNotification(Request $request)
    {
        $message = $request->Message;

        if($request->userId!=NULL)
        {
            $Users=explode(",",$request->userId);

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

            \Session::flash('success', 'well done! Message notification successfully sent');
            return Redirect('/allNotification');
        }
        else if($request->group!=NULL)
        {
            $group = Group::where('id',$request->group)->first();

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
            \Session::flash('success', 'well done! Message notification successfully sent to '.$group->name.' group!');
            return Redirect('/allNotification');
        }
    }
}
