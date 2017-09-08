<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReseachersDetailsTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseachers_details_tabs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('new_user_id')->unsigned();
            $table->foreign('new_user_id')->references('id')->on('new_users');
            $table->string('gps_lat');
            $table->string('gps_long');
            $table->string('img_url');
            $table->string('natureOfBusiness');
            $table->string('summaryBox');
            $table->string('researchNotes');
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
        Schema::dropIfExists('reseachers_details_tabs');
    }
}
