<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserRoles extends Eloquent
{
    public function users()
    {
        return $this->hasMany(NewUser::class);
    }
}
