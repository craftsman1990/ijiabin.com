<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePraisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_praises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('点赞人ID');
            $table->integer('by_praise_id')->comment('被点赞的ID');
            $table->tinyInteger('type')->comment('属性(1:评论点赞,2:再说)');
            $table->tinyInteger('status')->comment('状态(0:已取消;1:已点)');
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
        Schema::dropIfExists('dx_praises');
    }
}
