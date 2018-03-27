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

            $recepient  = NewUser::where('id',$conversation->Receiver_id)->first();

            $messageNotification = $user->name.":".$message;

            $PlayerId = $recepient->playerID;

            $newNotification = new NotificationService();
            $newNotification->sendToOne($messageNotification,$PlayerId);

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

            $recepient1  = NewUser::where('id',$conversation->Sender_id)->first();

            $messageNotification = $user->name.":".$message;

            $PlayerId = $recepient1->playerID;

            $newNotification = new NotificationService();
            $newNotification->sendToOne($messageNotification,$PlayerId);

            $respond['msg']="Sent";

            return response()->json($respond);
        }
    }

    public function getMessagesPerConvo()
    {
        $conversation_id = Input::get('conversation_id');

        $messages = ChatMessage::where('conversation_id',$conversation_id)
            ->join('new_users', 'new_users.id', '=', 'chat_messages.new_user_id')
            ->select(
                \DB::raw("
                                            chat_messages.id,
                                            chat_messages.conversation_id,
                                            new_users.name,
                                            new_users.surname,
                                            chat_messages.message,
                                            chat_messages.user_type,
                                            chat_messages.created_at
                                        ")
            )
            ->get();

        return response()->json($messages);
    }

}
