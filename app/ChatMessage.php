<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public function messages()
    {
        return $this->belongsTo(Conversation::class,'conversation_id','id');

    }
}
