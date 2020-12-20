<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->increments ('id');
            $table->string('slug', 50)->comment('教師代號')->nullable()->default(NULL);
            $table->string('name', 50)->comment('教師名稱')->nullable()->default(NULL);
            $table->string('headline', 100)->comment('標題/概述 ')->nullable()->default(NULL);
            $table->text('introduction')->comment('內容/介紹 ')->nullable()->default(NULL);
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
        Schema::dropIfExists('tutors');
    }
}
