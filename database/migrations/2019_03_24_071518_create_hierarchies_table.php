<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHierarchiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hierarchies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('ancestor', false, true);
            $table->bigInteger('descendant', false, true);
            $table->bigInteger('depth', false, true);

            $table->foreign('ancestor')
                ->references('id')
                ->on('taxonomies')
                ->onDelete('cascade');

            $table->foreign('descendant')
                ->references('id')
                ->on('taxonomies')
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
        Schema::table('hierarchies', function (Blueprint $table) {
            $table->dropForeign(['ancestor', 'descendant']);
        });
        Schema::dropIfExists('hierarchies');
    }
}
