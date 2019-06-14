<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxUserAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_user_access', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('唯一用户标识：MAC地址/用户id');
            $table->integer('source_id')->comment('访问内容id');
            $table->tinyInteger('source_type')->comment('标识（1：文章；2：视频）')->default(1);
            $table->dateTime('entry_time')->comment('进入页面时间（年月日小时分钟秒）')->nullable();
            $table->dateTime('exit_time')->comment('退出页面时间（年月日小时分钟秒）')->nullable();
            $table->integer('duration')->comment('视频内容播放时长')->default(0);
            $table->string('source_address',255)->comment('来源地址')->nullable();
            $table->string('destination_address',255)->comment('去向地址')->nullable();
            $table->string('visitor_ip',20)->comment('访问者ip地址')->nullable();
            $table->string('visitor_provinces',20)->comment('访问者省份')->nullable();
            $table->string('visitor_city',20)->comment('访问者城市')->nullable();
            $table->string('browser_type',20)->comment('浏览器类型')->nullable();
            $table->string('resolution',20)->comment('设备分辨率')->nullable();
            $table->string('operating_system',20)->comment('操作系统')->nullable();
            $table->string('equipment',20)->comment('设备：PC/手机')->nullable();   
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
        Schema::dropIfExists('dx_user_access');
    }
}
