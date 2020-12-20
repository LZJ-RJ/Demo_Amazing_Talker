<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_languages', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('tutor_id')->comment('教師id');
            $table->foreign('tutor_id')
                ->references('id')
                ->on('tutors');

            $table->unsignedInteger('language_id')->comment('語言id');
            $table->foreign('language_id')
                ->references('id')
                ->on('languages');

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
        Schema::dropIfExists('tutor_languages');
    }
}
