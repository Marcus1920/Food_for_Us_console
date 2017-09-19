<?php

namespace App\Services;


use App\TransactionStatus;

class transactionService
{

    public function transactionStatuses()
    {
        return TransactionStatus::all();
    }

}