<?php

use Illuminate\Database\Seeder;
use App\Models\AppIntroSlide;

class IntroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppIntroSlide::create([
            'order' => 1,
            'en' => ['title' => 'Slide 01', "content" => "Slide 01 content 1111"],
            'ar' => ['title' => 'سلايد 1', "content" => "سلايد 1 محتوى 1111"],
        ]);
        AppIntroSlide::create([
            'order' => 2,
            'en' => ['title' => 'Slide 02', "content" => "Slide 02 content 2222"],
            'ar' => ['title' => 'سلايد 2', "content" => "سلايد 2 محتوى 2222"],
        ]);
        AppIntroSlide::create([
            'order' => 3,
            'en' => ['title' => 'Slide 03', "content" => "Slide 03 content 3333"],
            'ar' => ['title' => 'سلايد 3', "content" => "سلايد 3 محتوى 3333"],
        ]);

    }
}
