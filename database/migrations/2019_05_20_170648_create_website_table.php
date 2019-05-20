<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',30)->comment('网站名称')->nullable();
            $table->string('url',100)->comment('网站URL')->nullable();
            $table->string('keywords',50)->comment('关键字')->nullable();
            $table->tinyInteger('status')->comment('状态（0：关闭；1：显示）')->default(1);
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
        Schema::dropIfExists('website');
    }
}
