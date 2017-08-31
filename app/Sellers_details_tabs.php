<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Sellers_details_tabs extends Eloquent
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
		 'description',
		 'country',
		 'city',
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

    public  function User(){

        return $this->belongsTo(NewUser::class,'new_user_id','id');
    }
    public  function Products(){

        return $this->belongsTo(ProductType::class,'product_type','id');
    }

    public  function Packaging(){

        return $this->belongsTo(ProductType::class,'packaging','id');
    }
}
