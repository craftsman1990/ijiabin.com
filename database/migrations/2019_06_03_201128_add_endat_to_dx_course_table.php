<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEndatToDxCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dx_course', function (Blueprint $table) {
            $table->dateTime('end_at')->comment('课程内容更新完结的时间')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dx_course', function (Blueprint $table) {
            //
             $table->dropColumn('content_nums');
        });
    }
}
