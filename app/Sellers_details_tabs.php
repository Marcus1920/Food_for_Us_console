<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sellers_details_tabs extends Model
{
    public  $directory   = "/images/";

    protected $fillable=[

         'product_picture',
         'location',
         'gps_lat',
         'gps_long',
         'product_type',
         'quantity',
         'cost_per_kg',
         'packaging',
         'available_hours',
         'payment_methods',
         'transaction_rating'

        ];

    public  function  getPathAttribute($value)
    {

        return $this->directory .$value;
    }

    public  function newuser()
    {
       return $this->belongsTo(NewUser::class,'new_user_id','id');

    }
}
