<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModCoverToCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dx_course', function (Blueprint $table) {
            //
            $table->renameColumn('cover','crosswise_cover')->comment('横向封面');
            $table->string('lengthways_cover',255)->comment('纵向封面');
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
            $table->renameColumn('crosswise_cover','cover')->comment('封面');
            $table->dropColumn('lengthways_cover');
        });
    }
}
