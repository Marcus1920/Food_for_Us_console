<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionActivity extends Model
{
    protected  $table = 'transaction_activities';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
