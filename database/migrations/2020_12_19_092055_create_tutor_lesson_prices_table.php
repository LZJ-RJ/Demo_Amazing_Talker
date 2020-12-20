<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorLessonPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_lesson_prices', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('tutor_id')->comment('教師id')->nullable()->default(NULL);
            $table->foreign('tutor_id')
                ->references('id')
                ->on('tutors');

            $table->float('trial_price', 11, 0)->comment('試上課程')->nullable()->default(NULL);
            $table->float('normal_price', 11, 0)->comment('一般課程')->nullable()->default(NULL);
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
        Schema::dropIfExists('tutor_lesson_prices');
    }
}
