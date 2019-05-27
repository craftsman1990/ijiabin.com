<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToUsersTalbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->tinyInteger('status')->comment('是否被禁用：1正常，2禁用')->default(1);
            $table->integer('code')->comment('验证码')->nullable();
            $table->string('authentication',255)->comment('个人认证')->nullable();
            $table->string('position',255)->comment('职位')->nullable();
            $table->string('company',255)->comment('公司信息')->nullable();
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->dropColumn('code');
            $table->dropColumn('authentication');
            $table->dropColumn('position');
            $table->dropColumn('company');
        });
    }
}
