<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户ID')->unsigned()->index();
            $table->text('question')->comment('问题内容');
            $table->string('contact',100)->comment('联系方式');
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
        Schema::dropIfExists('dx_feedback');
    }
}
