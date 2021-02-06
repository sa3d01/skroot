<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_category_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_category_id');
            $table->string('locale')->index();

            $table->string('name');

            $table->unique(['part_category_id', 'locale']);
            $table->foreign('part_category_id')->references('id')
                ->on('part_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_category_translations');
    }
}
