<?php

use App\Models\ProblemType;
use Illuminate\Database\Seeder;

class GeneralConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProblemType::create([
            "label_en" => "zh2t mn ktr L gmdan",
            "label_ar" => "زهقت من كتر الجمدان",
        ]);
        ProblemType::create([
            "label_en" => "no 3'lta 5als",
            "label_ar" => "مفيكوش غلطة",
        ]);

    }
}
