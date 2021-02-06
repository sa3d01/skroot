<?php

use Illuminate\Database\Seeder;
use App\Models\CarBrand;
use App\Models\CarBrandModel;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car1 = CarBrand::create([
            'en' => ['name' => 'Mercedes Benz'],
            'ar' => ['name' => 'مرسيدس بينز'],
        ]);
        CarBrandModel::create([
            'car_brand_id' => $car1->id,
            'en' => ['name' => 'Mercedes Model 01'],
            'ar' => ['name' => 'مرسيدس موديل 01'],
        ]);
        CarBrandModel::create([
            'car_brand_id' => $car1->id,
            'en' => ['name' => 'Mercedes Model 02'],
            'ar' => ['name' => 'مرسيس موديل 02'],
        ]);

        //

        $car2 = CarBrand::create([
            'en' => ['name' => 'Reno'],
            'ar' => ['name' => 'رينو'],
        ]);
        CarBrandModel::create([
            'car_brand_id' => $car2->id,
            'en' => ['name' => 'Reno Model 01'],
            'ar' => ['name' => 'رينو موديل 01'],
        ]);
        CarBrandModel::create([
            'car_brand_id' => $car2->id,
            'en' => ['name' => 'Reno Model 02'],
            'ar' => ['name' => 'رينو موديل 02'],
        ]);

    }
}
