<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTravelRadiiTable extends Migration
{

    public function up()
    {
        Schema::create('user_travel_radii', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kilometres');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_travel_radii');
    }
}
