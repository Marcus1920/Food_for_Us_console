<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerDetail extends Model
{

    public  function transaction()
    {
        return $this->hasMany(Transaction::class);

    }
    protected $table ="buyer_details";

    public function buyerTransactions()
    {
        return $this->hasMany(Transaction::class);

    }
}
