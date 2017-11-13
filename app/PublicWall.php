<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicWall extends Model
{
    use SoftDeletes;
    protected $table='public_wall';
    protected $dates = ['deleted_at'];

    public  function users()
    {
        return $this->belongsTo(User::class,'poster','id');
    }
}
