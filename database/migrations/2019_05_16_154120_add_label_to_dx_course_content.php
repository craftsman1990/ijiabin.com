<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLabelToDxCourseContent extends Migration
{
    /**
     * Run the migrations.
     *3
     * @return void
     */
    public function up()
    {
        //
        Schema::table('dx_course_content', function (Blueprint $table) {
            //
            $table->string('label',20)->comment('标签');
            $table->integer('try_time')->comment('试看时间')->default(0);
            $table->string('cover',255)->comment('封面图');
            $table->integer('play_num')->comment('播放量')->default(0);
            $table->tinyInteger('status')->comment('是否更新上架：0：否，1：是')->default(0);
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
         Schema::table('dx_course_content', function (Blueprint $table) {
            //
            $table->dropColumn('label');
            $table->dropColumn('try_time');
            $table->dropColumn('cover');
            $table->dropColumn('play_num');
            $table->dropColumn('status');
        });
    }
}
