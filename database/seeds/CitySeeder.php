<?php

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $country = Country::create([
            'en' => ['name' => 'UAE', "currency" => "AED"],
            'ar' => ['name' => 'الإمارات', "currency" => "درهم"],
        ]);

        City::create([
            'country_id' => $country->id,
            'delivery_fee' => 12.50,
            'en' => ['name' => 'Dubai'],
            'ar' => ['name' => 'دبي'],
        ]);
        City::create([
            'country_id' => $country->id,
            'delivery_fee' => 14,
            'en' => ['name' => 'Mecca'],
            'ar' => ['name' => 'مكة'],
        ]);

    }
}
