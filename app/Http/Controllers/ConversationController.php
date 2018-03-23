<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;

class ConversationController extends Controller
{


    public function index()
    {
        $conversation = Conversation::all();
        return Response()->json($conversation);
    }



}
