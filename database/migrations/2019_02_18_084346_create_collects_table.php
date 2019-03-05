<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_collect', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('收藏人ID');
            $table->integer('by_collect_id')->comment('被收藏的ID');
            $table->tinyInteger('type')->comment('属性(1:收藏课程,2:收藏评论)');
            $table->tinyInteger('status')->comment('状态(0:未收藏;1:已收藏)');
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
        Schema::dropIfExists('dx_collect');
    }
}
