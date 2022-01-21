<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtrafieldExtrafieldTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extrafield__extrafield_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('extrafield_id')->unsigned();
            $table->string('translatable_name')->nullable();
            $table->text('translatable_value')->nullable();
            $table->string('locale')->index();
            $table->unique(['extrafield_id', 'locale'], 'extrafield_id_locale_unique');
            $table->foreign('extrafield_id', 'extrafield_id_foreign')->references('id')->on('extrafield__extrafields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extrafield__extrafield_translations', function (Blueprint $table) {
            $table->dropForeign(['extrafield_id']);
        });
        Schema::dropIfExists('extrafield__extrafield_translations');
    }
}
