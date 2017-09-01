<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerDetail extends Model
{

    protected $table ="buyer_details";


    public  function transaction()
    {
        return $this->hasMany(Transaction::class);


    }
    

    public function buyerTransactions()
    {
        return $this->hasMany(Transaction::class);



    }
}
