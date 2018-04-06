<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;
use Illuminate\Support\Facades\Input;
use App\NewUser;
use App\Sellers_details_tabs;
use App\ChatMessage;
use App\HideChatMessage;

class ConversationController extends Controller
{
    public function createConversation()
    {
        $respond=array();

        $post_id = Input::get('post_id');

        $api_key = Input::get('api_key');

        $user  = NewUser::where('api_key',$api_key)->first();

        $conversation = Conversation::where('Post_id',$post_id)
             ->where('Sender_id',$user->id)
            ->orWhere('Receiver_id',$user->id)->first();


        $post = Sellers_details_tabs::where('id',$post_id)->first();

        $receiver = NewUser::where('id',$post->new_user_id)->first();

        if($conversation==NULL)
        {
            $newConversation = new Conversation();
            $newConversation->Sender_id = $user->id;
            $newConversation->SenderName = $user->name.' '.$user->surname;
            $newConversation->Receiver_id = $receiver->id;
            $newConversation->ReceiverName = $receiver->name.' '.$receiver->surname;
            $newConversation->Post_id = $post->id;
            $newConversation->created_at = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
            $newConversation->save();

            $newChatMessage = new ChatMessage();
            $newChatMessage->conversation_id = $newConversation->id;
            $newChatMessage->new_user_id = $receiver->id;
            $newChatMessage->message = "Hi ".$user->name;
            $newChatMessage->user_type = "Receiver";
            $newChatMessage->created_at = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
            $newChatMessage->save();

            $newConversationStatus = new HideChatMessage();
            $newConversationStatus->conversation_id = $newConversation->id;
            $newConversationStatus->new_users_id = $receiver->id;
            $newConversationStatus->status = 1;
            $newConversationStatus->created_at = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
            $newConversationStatus->save();

            $newConversationStatus1 = new HideChatMessage();
            $newConversationStatus1->conversation_id = $newConversation->id;
            $newConversationStatus1->new_users_id = $user->id;
            $newConversationStatus1->status = 1;
            $newConversationStatus1->created_at = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
            $newConversationStatus1->save();

            $messages = ChatMessage::where('conversation_id',$newConversation->id)
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
        else
        {
            HideChatMessage::where('new_users_id',$user->id)
                ->where('conversation_id',$conversation->id)
                ->update(['status'=>1]);

            $messagesExist = ChatMessage::where('conversation_id',$conversation->id)->exists();

            if($messagesExist==NULL)
            {

                $respond['conversation_id']=$conversation->id;

                return response()->json($respond);
            }
            else
            {
                $messages = ChatMessage::where('conversation_id',$conversation->id)
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
    }

    public function getConverstation()
    {
        $respond=array();

        $post_id = Input::get('post_id');

        $api_key = Input::get('api_key');

        $user  = NewUser::where('api_key',$api_key)->first();

        $conversation = Conversation::where('Post_id',$post_id)
            ->where('Sender_id',$user->id)
            ->orWhere('Receiver_id',$user->id)->first();

        $convo = Conversation::where('id',$conversation->id)->first();

        $respond['conversation_id']=$convo->id;

        return response()->json($respond);
    }

    public function getMyConversation()
    {
        $api_key = Input::get('api_key');

        $user  = NewUser::where('api_key',$api_key)->first();

        $conversations = HideChatMessage::where('new_users_id',$user->id)
            ->where('status','=',1)
            ->join('conversations', 'conversations.id', '=', 'hide_chat_messages.conversation_id')
            ->get();

        return response()->json($conversations);
    }

    public function hideConversation()
    {
        $respond=array();

        $api_key = Input::get('api_key');

        $conversation_id = Input::get('conversation_id');

        $user  = NewUser::where('api_key',$api_key)->first();

        HideChatMessage::where('new_users_id',$user->id)
            ->where('conversation_id',$conversation_id)
            ->update(['status'=>0]);

        $respond['message']="Successfully deleted conversation";

        return response()->json($respond);
    }
}
