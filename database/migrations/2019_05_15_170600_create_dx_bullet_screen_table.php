<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxBulletScreenTable extends Migration
{
    /**
     * Run the migrations.
     *1
     * @return void
     */
    public function up()
    {
        Schema::create('dx_bullet_screen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户ID')->nullable();
            $table->integer('content_id')->comment('课程内容（视频）ID')->nullable();
            $table->string('text',50)->comment('弹幕内容')->nullable();
            $table->integer('pace')->comment('播放进度')->nullable();
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
        Schema::dropIfExists('dx_bullet_screen');
    }
}
