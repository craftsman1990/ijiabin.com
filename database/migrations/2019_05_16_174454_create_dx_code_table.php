<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxCodeTable extends Migration
{
    /**
     * Run the migrations.
     *5
     * @return void
     */
    public function up()
    {
        Schema::create('dx_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile',30)->comment('手机号');
            $table->string('code',30)->comment('验证码');
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
        Schema::dropIfExists('dx_code');
    }
}
