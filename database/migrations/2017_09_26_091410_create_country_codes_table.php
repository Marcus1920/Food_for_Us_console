<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('internet');
            $table->string('dial_code');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('country_code');
    }
}
