<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPickupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_pickup_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SellersPostId')->unsigned();
            $table->date('sellByDate');
            $table->string('PickUpAddress');
            $table->string('MonToFridayHours');
            $table->string('SaturdayHours');
            $table->string('SundayHours');
            $table->string('gps_lat');
            $table->string('gps_long');
            $table->foreign('SellersPostId')->references('id')->on('sellers_details_tabs');
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
        Schema::dropIfExists('product_pickup_details');
    }
}
