<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    public  function Group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public  function GroupUser()
    {
        return $this->belongsTo(NewUser::class, 'new_user_id', 'id');
    }
}