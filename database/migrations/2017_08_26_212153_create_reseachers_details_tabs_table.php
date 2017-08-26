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
            $table->integer('new_user_id');
            $table->string('img_url');
            $table->string('nature_of_business');
            $table->string('summary_box');
            $table->string('research_notes');
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
