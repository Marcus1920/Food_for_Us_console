<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewUsersTable extends Migration
{

    public function up()
    {
        Schema::create('new_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profilePicture');
            $table->bigInteger('idNumber');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('descriptionOfAcces');
            $table->string('password');
            $table->string('api_key');
            $table->string('gps_lat');
            $table->string('gps_long');
            $table->integer('cellphone');
            $table->string('location');
            $table->integer('travelRadius')->unsigned();
            $table->integer('intrest')->unsigned();
            $table->integer('active')->unsigned();
            $table->foreign('intrest')->references('id')->on('user_roles');
            $table->foreign('active')->references('id')->on('user_statuses');
            $table->foreign('travelRadius')->references('id')->on('user_travel_radii');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_users');
    }
}
