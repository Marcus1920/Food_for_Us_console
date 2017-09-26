<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicWallTable extends Migration
{

    public function up()
    {
        Schema::create('public_wall', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imgurl');
            $table->string('name');
            $table->string('description');
            $table->string('ingredients');
            $table->string('methods');
            $table->string('type');
            $table->integer('poster')->unsigned();
            $table->foreign('poster')->references('id')->on('users');
            $table->timestamps();
        });
    }


    public function down()
    {

    }
}