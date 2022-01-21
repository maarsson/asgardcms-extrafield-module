<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtrafieldExtrafieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extrafield__extrafields', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('block_id')->unsigned();
            $table->string('name')->nullable();
            $table->text('value')->nullable();
            $table->timestamps();
            $table->unique(['block_id', 'name'], 'block_id_name_unique');
            $table->foreign('block_id', 'block_id_foreign')->references('id')->on('block__blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extrafield__extrafields', function (Blueprint $table) {
            $table->dropForeign(['block_id']);
        });
        Schema::dropIfExists('extrafield__extrafields');
    }
}
