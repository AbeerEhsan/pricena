<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SliderLang;
use Faker\Generator as Faker;

$factory->define(SliderLang::class, function (Faker $faker) {

    return [
        'description' => $faker->text,
        'slider_id' => $faker->randomElement(\App\Models\Slider::all()->pluck('id')->toArray()),
        'lang_id' => $faker->randomElement(\App\Models\Language::all()->pluck('id')->toArray()),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
