<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicWall extends Model
{
    protected $table='public_wall';
    public  function  newusers()
    {
        return $this->belongsTo(NewUser::class,'poster','id');
    }
}
