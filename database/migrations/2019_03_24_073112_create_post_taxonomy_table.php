<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_taxonomy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('taxonomy_id', false, true);
            $table->bigInteger('post_id', false, true);
            $table->integer('order', false, true)->default(0);

            $table->foreign('taxonomy_id')
                ->references('id')
                ->on('taxonomies')
                ->onDelete('cascade');

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_taxonomy', function (Blueprint $table) {
            $table->dropForeign(['taxonomy_id', 'post_id']);
        });
        Schema::dropIfExists('post_taxonomy');
    }
}
