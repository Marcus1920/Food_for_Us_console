<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDefaultLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_default_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->string('gps_lat');
            $table->string('gps_long');
            $table->foreign('userId')->references('id')->on('new_users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_default_locations');
    }
}
