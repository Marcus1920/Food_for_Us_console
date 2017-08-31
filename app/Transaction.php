<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
<<<<<<< HEAD
=======
<<<<<<< HEAD
    protected  $table="transactions";
>>>>>>> 2366d3e2ffbc965ebe19f9dd95995bd81e1c20ae

    protected  $table="transactions";




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
<<<<<<< HEAD



    public function sellers()
        {
           return $this->belongsTo(Sellers_details_tabs::class,'seller_id','id');

        }
    public function buyers()
        {
           return $this->belongsTo(BuyerDetail::class,'buyer_id','id');

        }

=======
>>>>>>> origin/master
>>>>>>> 2366d3e2ffbc965ebe19f9dd95995bd81e1c20ae

}
