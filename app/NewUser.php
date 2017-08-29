<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewUser extends Model
{
    //

    public  function  Sellers_details_tabss()
    {
        return $this->hasMany(Sellers_details_tabs::class);
    }

    public  function  publicwallpost()
    {
        return $this->hasMany(PublicWall::class);
    }
}
