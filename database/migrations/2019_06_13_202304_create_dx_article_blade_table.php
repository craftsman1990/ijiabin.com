<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxArticleBladeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_article_blade', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aid')->comment('文章ID');
            $table->text('pic_info')->comment('图片信息(数据结构为【封面图cover】的json_encode数组)')->nullable();
            $table->text('video_info')->comment('视频信息(数据结构为【视频地址address】、【视频时长duration】的json_encode数组)')->nullable();
            $table->text('audio_info')->comment('音频信息(数据结构为audio_url的json_encode数组)')->nullable();
            $table->timestamps();
            $table->unique('aid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dx_article_blade');
    }
}
