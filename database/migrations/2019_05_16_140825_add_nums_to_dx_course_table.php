<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumsToDxCourseTable extends Migration
{
    /**
     * Run the migrations.
     *2
     * @return void
     */
    public function up()
    {
        //
        Schema::table('dx_course', function (Blueprint $table) {
            //
            $table->integer('content_nums')->comment('课程内容总节数');
            $table->integer('content_updates')->comment('课程内容已更新的节数');
            $table->tinyInteger('is_end')->comment('课程内容是否已完结：0：未完结，1:已完结');
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
        Schema::table('dx_course', function (Blueprint $table) {
            //
            $table->dropColumn('content_nums');
            $table->dropColumn('content_updates');
            $table->dropColumn('is_end');
        });
    }
}
