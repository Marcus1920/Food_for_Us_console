<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transactionId')->unsigned();
            $table->integer('userId');
            $table->string('rating');
            $table->string('comment');
            $table->foreign('transactionId')->references('id')->on('transactions');
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
        Schema::dropIfExists('transaction_ratings');
    }
}
