<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicWall extends Model
{
    protected $table='public_wall';
    public  function users()
    {
        return $this->belongsTo(User::class,'poster','id');
    }
}
