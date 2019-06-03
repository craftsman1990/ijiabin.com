<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxContentNumsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_content_nums_log', function (Blueprint $table) {
            $table->string('courseid_contentnums',155)->comment('关键字cource表的ID+contentNums');
            $table->integer('nums')->comment('统计值')->default(1);
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
        Schema::dropIfExists('dx_content_nums_log');
    }
}
