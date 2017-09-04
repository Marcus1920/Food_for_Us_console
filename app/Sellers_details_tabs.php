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
         'productType',
         'quantity',
         'costPerKg',
         'packaging',
         'availableHours',
         'paymentMethods',
		 'description',
		 'country',
		 'city',
         'transactionRating'

        ];

    public  function  getPathAttribute($value)
    {
        return $this->directory .$value;
    }

    public  function newuser()
    {
       return $this->belongsTo(NewUser::class,'new_user_id','id');

    }

    public  function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function cartItems()
    {
        return $this->hasOne(Cart::class);
	}

    public  function User(){

        return $this->belongsTo(NewUser::class,'new_user_id','id');
    }
    public  function Products(){

        return $this->belongsTo(ProductType::class,'productType','id');
    }

    public  function Packaging()
    {
        return $this->belongsTo(Packaging::class, 'packaging', 'id');
    }

}
