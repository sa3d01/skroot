<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppIntroSlideTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_intro_slide_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_intro_slide_id');
            $table->string('locale')->index();

            $table->string('title');
            $table->string('content');

            $table->unique(['app_intro_slide_id', 'locale']);
            $table->foreign('app_intro_slide_id')->references('id')
                ->on('app_intro_slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_intro_slide_translations');
    }
}
