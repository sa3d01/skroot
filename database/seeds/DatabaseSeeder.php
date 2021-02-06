<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IntroSlideSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CarBrandSeeder::class);
        $this->call(PartCategoriesTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call('FolderTableSeeder');
        $this->call('EmailSeeder');
        $this->call(StaticPagesTableSeeder::class);
        $this->call(GeneralConfigsSeeder::class);
    }
}
