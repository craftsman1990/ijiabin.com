<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyJbpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_apply_jbp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->comment('姓名');
            $table->tinyInteger('sex')->comment('性别(0:女;1:男)');
            $table->char('mobile',11)->comment('手机号');
            $table->string('weixin',50)->comment('微信号');
            $table->string('company',50)->comment('公司名称');
            $table->string('position',50)->comment('职位');
            $table->string('establish',30)->comment('公司成立日期');
            $table->string('income',50)->comment('去年营收');
            $table->string('market_value',50)->comment('公司市值');
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
        Schema::dropIfExists('dx_apply_jbp');
    }
}
