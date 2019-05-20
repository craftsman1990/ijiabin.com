<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypesDxComment extends Migration
{
    /**
     * Run the migrations.
     *4
     * @return void
     */
    public function up()
    {
        //
         Schema::table('dx_comment', function (Blueprint $table) {
            //
            $table->tinyInteger('type')->comment('属性(1;议题评论,2:课程评论,3:课程内容评论)');
            $table->float('grade',8,1)->comment('分数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('dx_comment', function (Blueprint $table) {
            //
            $table->dropColumn('type');
            $table->dropColumn('grade');
        });
    }
}
