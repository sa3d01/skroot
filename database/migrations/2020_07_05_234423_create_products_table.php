<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('type'); // [NEW_PART,USED_PART,ACCESSORY]
            $table->unsignedBigInteger('car_brand_id')->nullable();
            $table->unsignedBigInteger('car_brand_model_id')->nullable();
            $table->unsignedBigInteger('part_category_id')->nullable();
            $table->unsignedInteger('year')->nullable();
            $table->double('price')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
