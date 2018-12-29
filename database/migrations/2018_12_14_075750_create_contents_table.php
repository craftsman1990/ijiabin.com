<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_course_content', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50);
            $table->string('intro',255);
            $table->string('time',20);
            $table->string('video',255);
            $table->string('audio',255);
            $table->text('content');
            $table->tinyInteger('type');
            $table->integer('course_id');
            $table->integer('chapter');
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
        Schema::dropIfExists('dx_course_content');
    }
}
