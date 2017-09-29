<?php

use Illuminate\Database\Seeder;
use App\TransactionStatus;

class TransactionStatusTableSeeder extends Seeder
{


    public function run()
    {
        TransactionStatus::create(['id' => '1','name' => 'New' ,'slug' => 'New']);
        TransactionStatus::create(['id' => '2','name' => 'Active' ,'slug' => 'Active']);
        TransactionStatus::create(['id' => '3','name' => 'Completed' ,'slug' => 'Completed']);
        TransactionStatus::create(['id' => '4','name' => 'Cancelled' ,'slug' => 'Cancelled']);
        TransactionStatus::create(['id' => '5','name' => 'Declined' ,'slug' => 'Declined']);
        TransactionStatus::create(['id' => '6','name' => 'Deleted' ,'slug' => 'Deleted']);

    }
}
