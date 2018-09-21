<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admin_name')->unique();
            $table->string('password');
            $table->string('nickname');
            $table->string('email')->unique();
            $table->string('admin_pid');
            $table->string('login_ip');
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
        Schema::dropIfExists('hp_admins');
    }
}
