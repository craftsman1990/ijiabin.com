<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedToContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dx_course_content', function (Blueprint $table) {
            //
            $table->tinyInteger('updated')->comment('是否更新：0：否，1：是')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dx_course_content', function (Blueprint $table) {
            $table->dropColumn('updated');
        });
    }
}
