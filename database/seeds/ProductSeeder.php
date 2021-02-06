<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\CarBrandModel;
use App\Http\Enums\ProductTypes;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carBrandModel = CarBrandModel::first();
        Product::create([
            'type' => ProductTypes::PART,
            'car_brand_id' => $carBrandModel->car_brand_id,
            'car_brand_model_id' => $carBrandModel->id,
            'part_category_id' => 1,
            'year' => 2021,
            'price' => 203.70,
            'en' => ['name' => 'Best tyre', 'description' => "it is the best tyre ever"],
            'ar' => ['name' => 'أحلى كاوتش', 'description' => "هو ده أحلى كاوتش في الدنيا"],
        ]);

        Product::create([
            'type' => ProductTypes::ACCESSORY,
            'car_brand_id' => $carBrandModel->car_brand_id,
            'car_brand_model_id' => $carBrandModel->id,
            'part_category_id' => 1,
            'year' => 2020,
            'price' => 42.50,
            'en' => ['name' => 'Best accessory', 'description' => "it is the best accessory ever"],
            'ar' => ['name' => 'أحلى أكسيسوري', 'description' => "هو ده أحلى أكسيسوري في الدنيا"],
        ]);


    }
}
