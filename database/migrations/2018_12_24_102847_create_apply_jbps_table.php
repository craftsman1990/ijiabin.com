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
            $table->date('birthday')->comment('微信号');
            $table->string('address',255)->comment('常住地');
            $table->integer('venture_years')->comment('创业年数');
            $table->integer('identity')->comment('身份属性(多选):1.创业者,2.投资人,3.其他(可手动输入)');
            $table->char('mobile',11)->comment('手机号');
            $table->string('weixin',50)->comment('微信号');
            $table->string('email',255)->comment('邮箱');
            $table->string('graduate_scholl',255)->comment('毕业院校');
            $table->string('education_background',255)->comment('学历');
            $table->string('company',255)->comment('企业全称');
            $table->string('position',255)->comment('职位');
            $table->string('establish',255)->comment('企业成立年份');
            $table->string('income',255)->comment('去年营收');
            $table->string('market_value',255)->comment('公司市值');
            $table->string('investor',255)->comment('本企业投资方');
            $table->string('operation_state',255)->comment('企业经营状况');
            $table->string('expectation',255)->comment('期望服务(多选)：1.标杆企业深度访学,2.政府资源对接,3.品牌宣传,4.投融资机会,5.校友交流,6.高管学习,7.其他(可手动输入)');
            $table->string('interest_in',255)->comment('感兴趣的人/企业');
            $table->string('pay_attention',255)->comment('最重视的(多选):1.和谁在一起（学员）学习交流,2.向谁学习,3.课程设计,4.学习时间,5.学习地点,6.学费,7.其他(可手动输入)');
            $table->string('referrer',255)->comment('推荐人');
            $table->string('referrer_mobile',255)->comment('推荐人联系方式');
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
