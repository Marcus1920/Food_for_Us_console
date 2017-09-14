<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicWall extends Model
{
    protected $table='public_wall';
<<<<<<< HEAD
=======
    public  function users()
    {
        return $this->belongsTo(User::class,'poster','id');
    }
>>>>>>> 66bb614a83e23eeb9173d3c015909337daabf353
}
