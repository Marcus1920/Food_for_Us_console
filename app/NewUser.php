<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewUser extends Model
{
    //

    public  function  Sellers_details_tabss(){


        return $this->hasMany('App\Sellers_details_tabs');
    }
}
