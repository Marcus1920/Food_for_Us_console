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
            $table->integer('new_user_id')->unsigned()->nullable()->idex();
            $table->string('product_picture');
            $table->string('location');
            $table->string('gps_lat');
            $table->string('gps_long');
            $table->string('product_type');
            $table->string('quantity');
            $table->string('cost_per_kg');
            $table->string('packaging');
            $table->string('available_hours');
            $table->string('payment_methods');
            $table->string('transaction_rating');
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
