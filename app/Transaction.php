<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{



    protected $table ='transactions';
    protected $fillable=[

        'seller_id',
        'buyer_id',
        'status',
        'product_type',
    ];


    public  function sellers_details_tabs()
    {
        return $this->belongsTo(Sellers_details_tabs::class);

    }

    public  function buyer_details()
    {
        return $this->belongsTo(BuyerDetail::class);

    }

}
