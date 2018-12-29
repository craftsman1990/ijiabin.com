<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discussion_id')->comment('议题ID');
            $table->text('content')->comment('评论内容');
            $table->integer('user_id')->comment('评论人ID');
            $table->integer('praise')->comment('点赞数');
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
        Schema::dropIfExists('dx_comment');
    }
}
