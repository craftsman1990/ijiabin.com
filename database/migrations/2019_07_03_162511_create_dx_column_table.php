<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_column', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',30)->comment('栏目名称')->nullable();
            $table->string('cover',255)->comment('封面图片')->nullable();
            $table->tinyInteger('sort')->comment('排序（默认0，值越大，排名越靠前）')->default(0);
            $table->tinyInteger('status')->comment('状态（0：不显示，1：正常显示）')->default(1);
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
        Schema::dropIfExists('dx_column');
    }
}