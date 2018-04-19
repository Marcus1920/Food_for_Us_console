<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{

    public function transactionActivities()
    {
        return $this->hasMany(TransactionActivity::class,'status','id');
    }

}
