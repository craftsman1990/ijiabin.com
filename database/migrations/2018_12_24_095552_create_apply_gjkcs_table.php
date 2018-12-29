<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyGjkcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_apply_gjkc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->comment('姓名');
            $table->tinyInteger('sex')->comment('性别(0:女;1:男)');
            $table->char('mobile',11)->comment('手机号');
            $table->string('weixin',50)->comment('微信号');
            $table->string('email',100)->comment('邮箱');
            $table->tinyInteger('is_stu')->comment('是否嘉宾学员（1：是，0：否）');
            $table->string('company',50)->comment('公司名称');
            $table->string('position',50)->comment('职位');
            $table->string('industry',30)->comment('行业');
            $table->tinyInteger('is_visa')->comment('是否有签证(1:是，0：否)');
            $table->string('channel',50)->comment('渠道');
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
        Schema::dropIfExists('dx_apply_gjkc');
    }
}
