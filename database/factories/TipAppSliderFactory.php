<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TipAppSlider;
use Faker\Generator as Faker;

$factory->define(TipAppSlider::class, function (Faker $faker) {

    return [
        'description' => $faker->word,
        'image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
