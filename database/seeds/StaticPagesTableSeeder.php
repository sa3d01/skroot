<?php

use Illuminate\Database\Seeder;
use App\Models\StaticPage;
use App\Http\Enums\StaticPageLabels;

class StaticPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StaticPage::create([
            "label" => StaticPageLabels::TERMS,
            'en' => ['title' => 'Terms & Conditions', "content" => "Content of the page is right here."],
            'ar' => ['title' => 'الشروط والأحكام', "content" => "محتوى صفحة الشروط هنا بالظبط."],
        ]);

        StaticPage::create([
            "label" => StaticPageLabels::PRIVACY,
            'en' => ['title' => 'Privacy Policy', "content" => "Content of the page is right here."],
            'ar' => ['title' => 'سياسة الخصوصية', "content" => "محتوى صفحة الخصوصية هنا بالظبط."],
        ]);

    }
}
