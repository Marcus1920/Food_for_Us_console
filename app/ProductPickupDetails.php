<?php

namespace App;
use App\Sellers_details_tabs;

use Illuminate\Database\Eloquent\Model;

class ProductPickupDetails extends Model
{
    public  function sellersPost()
    {
        return $this->belongsTo(Sellers_details_tabs::class,'SellersPostId','id');

    }
}
