<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCousersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('cover',255);
            $table->string('teacher',30);
            $table->string('professional',30);
            $table->text('intro');
            $table->tinyInteger('ify');
            $table->tinyInteger('is_pay');
            $table->integer('looks');
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
        Schema::dropIfExists('dx_course');
    }
}
