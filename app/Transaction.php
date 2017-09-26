<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected  $table="transactions";

    public $fillable=[

        'seller_id',
        'buyer_id',
        'status',
        'product',
        'quantity',
    ];


    public function sellers()
    {
        return $this->belongsTo(NewUser::class,'seller_id','id');

    }
    public function buyers()
    {
        return $this->belongsTo(NewUser::class,'buyer_id','id');

    }

    public function product()
    {
        return $this->belongsTo(Sellers_details_tabs::class,'product','id');

    }

    public function status()
    {
        return $this->belongsTo(TransactionStatus::class,'status','id');

    }
}
