<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_score_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gs_id')->comment('嘉分表ID');
            $table->integer('score')->comment('操作分数');
            $table->tinyInteger('type')->comment('属性(0:增加;1:减少)');
            $table->integer('old_score')->comment('原有分数');
            $table->string('behavior',255)->comment('操作名称');
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
        Schema::dropIfExists('dx_score_record');
    }
}
