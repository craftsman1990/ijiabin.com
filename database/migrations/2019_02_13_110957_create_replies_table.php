<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('relevance_id')->comment('评论或回复ID');
            $table->integer('user_id')->comment('回复人');
            $table->text('content')->comment('回复内容');
            $table->tinyInteger('type')->comment('属性(0:评论回复;1:回复回复)');
            $table->tinyInteger('status')->comment('状态(0:禁止，1:显示)');
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
        Schema::dropIfExists('dx_replies');
    }
}
