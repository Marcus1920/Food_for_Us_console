<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatMessage;
use Illuminate\Support\Facades\Input;
use App\Conversation;
use App\NewUser;
use App\Services\NotificationService;

class ChatMessageController extends Controller
{
    public function createMessage()
    {
        $respond=array();

        $conversation_id = Input::get('conversation_id');

        $api_key = Input::get('api_key');

        $message = Input::get('message');

        $user  = NewUser::where('api_key',$api_key)->first();

        $conversation = Conversation::where('id',$conversation_id)->first();

        $buyer = Conversation::where('Sender_id',$user->id)
            ->where('id',$conversation_id)->first();

        $receiver = Conversation::where('Receiver_id',$user->id)
            ->where('id',$conversation_id)->first();

        if($buyer!=Null)
        {
            $newChatMessage = new ChatMessage();
            $newChatMessage->conversation_id = $conversation_id;
            $newChatMessage->new_user_id = $user->id;
            $newChatMessage->message = $message;
            $newChatMessage->user_type = "Sender";
            $newChatMessage->save();

            $respond['msg']="Sent";

            return response()->json($respond);
        }
        else if($receiver!=Null)
        {
            $newChatMessage = new ChatMessage();
            $newChatMessage->conversation_id = $conversation_id;
            $newChatMessage->new_user_id = $user->id;
            $newChatMessage->message = $message;
            $newChatMessage->user_type = "Receiver";
            $newChatMessage->save();

            $respond['msg']="Sent";

            return response()->json($respond);
        }
    }
}
