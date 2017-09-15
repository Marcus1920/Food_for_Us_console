<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersDetailsTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers_details_tabs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('new_user_id')->unsigned();
            $table->foreign('new_user_id')->references('id')->on('new_users');
            $table->string('productPicture');
            $table->string('location');
            $table->string('gps_lat');
            $table->string('gps_long');
            $table->integer('productType')->unsigned();
            $table->foreign('productType')->references('id')->on('product_types');
            $table->string('quantity');
            $table->string('costPerKg');
            $table->string('description');
            $table->string('country');
            $table->string('city');
            $table->integer('packaging')->unsigned();
            $table->foreign('packaging')->references('id')->on('packagings');
            $table->string('availableHours');
            $table->string('paymentMethods');
            $table->string('transactionRating');
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
        Schema::dropIfExists('sellers_details_tabs');
    }
}
