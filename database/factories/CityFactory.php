<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {

    return [
        'name' => $faker->city,
        'lang_id' => $faker->randomElement(\App\Models\Language::all()->pluck('id')->toArray()),
        'country_id' => $faker->randomElement(\App\Models\Country::all()->pluck('id')->toArray()),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
