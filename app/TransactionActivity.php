<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transaction;

class TransactionActivity extends Model
{
    protected  $table = 'transaction_activities';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function transactionStatuses()
    {
        return $this->belongsTo(TransactionStatus::class,'status','id');
    }
    public function appUsers()
    {
        return $this->belongsTo(NewUser::class,'userId','id');
    }

}
