<?php

/** @var Factory $factory */

use App\Models\Country;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name_en' => $faker->country,
        'name_ar' => $faker->country,
    ];
});
