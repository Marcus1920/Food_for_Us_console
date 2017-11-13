<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionActivitiesTable extends Migration
{

    public function up()
    {
        Schema::create('transaction_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('transactionId')->unsigned();
            $table->integer('status')->unsigned();
            $table->foreign('userId')->references('id')->on('new_users');
            $table->foreign('transactionId')->references('id')->on('transactions');
            $table->foreign('status')->references('id')->on('transaction_statuses');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_activities');
    }
}
