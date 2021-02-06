<?php

use Illuminate\Database\Seeder;
use App\Models\PartCategory;

class PartCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PartCategory::create([
            'en' => ['name' => 'Tyres'],
            'ar' => ['name' => 'الإطارات'],
        ]);
        PartCategory::create([
            'en' => ['name' => 'Brakes'],
            'ar' => ['name' => 'الفرامل'],
        ]);
        PartCategory::create([
            'en' => ['name' => 'Battery'],
            'ar' => ['name' => 'البطارية'],
        ]);
    }
}
