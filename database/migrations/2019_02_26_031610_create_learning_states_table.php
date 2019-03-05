<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_learning_states', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户ID')->unsigned()->index();
            $table->integer('content_id')->comment('内容ID')->unsigned()->index();
            $table->tinyInteger('state')->comment('状态(0:学习中;1:已学完)')->default(0);
            $table->char('learning_time',5)->comment('学至');
            $table->tinyInteger('quiz_state')->comment('自测题状态(0:未做;1:已做)')->default(0);
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
        Schema::dropIfExists('dx_learning_states');
    }
}
