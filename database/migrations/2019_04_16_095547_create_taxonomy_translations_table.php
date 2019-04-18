<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('taxonomy_id', false, true);
            $table->string('locale')->index();

            $table->string('title')->index();
            $table->string('slug')->unique();
            $table->longText('description')->nullable();

            $table->unique(['taxonomy_id', 'locale']);
            $table->foreign('taxonomy_id')
                  ->references('id')
                  ->on('taxonomies')
                  ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taxonomy_translations', function (Blueprint $table) {
            $table->dropForeign(['taxonomy_id']);
        });
        Schema::dropIfExists('taxonomy_translations');
    }
}
