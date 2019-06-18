<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxLabelArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_label_article', function (Blueprint $table) {
            $table->integer('label_id')->comment('推荐位hg_label表id');
            $table->integer('aid')->comment('文章表hg_dx_article表ID');
            $table->integer('rank')->comment('权重（默认0.0(0.0-1.0)，值越大，排名越靠前)');
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
        Schema::dropIfExists('dx_label_article');
    }
}
