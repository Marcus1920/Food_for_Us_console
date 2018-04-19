<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageLogin extends Model
{
    public  function User(){

        return $this->belongsTo(NewUser::class,'new_user_id','id');
    }
}
