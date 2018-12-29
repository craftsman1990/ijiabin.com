<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('couser_id')->comment('课程ID');
            $table->string('title',50)->comment('订单名称');
            $table->float('price',8,2)->comment('订单价格');
            $table->tinyInteger('status')->comment('订单状态0:未支付;1:已支付');
            $table->dateTime('pay_time')->comment('支付时间');
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
        Schema::dropIfExists('dx_order');
    }
}
