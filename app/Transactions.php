<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Transactions extends Eloquent
{
    public  function Buyer(){

        return $this->belongsTo(NewUser::class,'buyer_id','id');
    }

    public  function Seller(){

        return $this->belongsTo(NewUser::class,'seller_id','id');
    }

    public  function Products(){

        return $this->belongsTo(ProductType::class,'product','id');
    }
}
