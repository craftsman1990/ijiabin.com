<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_discussion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->comment('议题标题');
            $table->string('cover',255)->comment('海报图片');
            $table->text('content')->comment('议题内容');
            $table->string('author',100)->comment('出题人');
            $table->dateTime('time')->comment('出题时间');
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
        Schema::dropIfExists('dx_discussion');
    }
}
