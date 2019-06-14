<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->comment('标题')->nullable();
            $table->tinyInteger('type')->comment('标识（1：文章；2：视频）')->default(1);
            $table->integer('duration')->comment('视频时长')->default(0);
            $table->text('label_id')->comment('（数据结构【标签id】、【标签权重0-1】的json_encode数组）')->nullable();
            $table->string('tag',255)->comment('关键字，多个用，隔开')->nullable();
            $table->string('cover',255)->comment('封面图')->nullable();
            $table->integer('looks')->comment('点击量')->default(1);
            $table->integer('cg_id')->comment('分类id')->nullable();
            $table->tinyInteger('status')->comment('状态（0：屏蔽；1：显示）')->default(1);
            $table->string('author',30)->comment('作者')->nullable();
            $table->dateTime('publish_time')->comment('发布时间');
            $table->string('intro',255)->comment('简介')->nullable();
            $table->longText('content')->comment('内容')->nullable();
            $table->dateTime('del_at')->comment('文章删除时间')->nullable();
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
        Schema::dropIfExists('dx_article');
    }
}
