<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected  $table="transactions";

    public function sellers()
        {
           return $this->belongsTo(Sellers_details_tabs::class,'seller_id','id');

        }
    public function buyers()
        {
           return $this->belongsTo(BuyerDetail::class,'buyer_id','id');

        }

}
