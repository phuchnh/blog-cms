<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id')->unsigned()->index();
            $table->string('meta_key');
            $table->longText('meta_value');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->unique(['post_id', 'meta_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_meta', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropUnique(['post_id', 'meta_key']);
        });
        Schema::dropIfExists('post_metas');
    }
}
