<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profilePicture');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->integer('intrest')->unsigned();
            $table->integer('cellphone');
            $table->string('location');
            $table->integer(  'travel_radius')->unsigned();
            $table->string('description_of_acces');
            $table->string('password');
            $table->foreign('intrest')->references('id')->on('user_roles');
            $table->integer('active')->unsigned();
            $table->foreign('active')->references('id')->on('user_statuses');
            $table->foreign('travel_radius')->references('id')->on('user_travel_radii');
            $table->string('api_key');
            $table->string('gps_lat');
            $table->string('gps_long');
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
        Schema::dropIfExists('new_users');
    }
}
