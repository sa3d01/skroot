<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarBrandModelTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_brand_model_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_brand_model_id');
            $table->string('locale')->index();

            $table->string('name');

            $table->unique(['car_brand_model_id', 'locale']);
            $table->foreign('car_brand_model_id')->references('id')->on('car_brand_models')
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
        Schema::dropIfExists('car_brand_model_translations');
    }
}
