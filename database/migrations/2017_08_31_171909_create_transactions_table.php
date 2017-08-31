<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->unsigned();
            $table->integer('seller_id')->unsigned();
            $table->integer('status');
            $table->integer('product')->unsigned();
            $table->integer('quantity');
            $table->foreign('buyer_id')->references('id')->on('new_users');
            $table->foreign('seller_id')->references('id')->on('new_users');
            $table->foreign('product')->references('id')->on('products');
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
        Schema::dropIfExists('transactions');
    }
}
