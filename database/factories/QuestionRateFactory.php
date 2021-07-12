<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QuestionRate;
use Faker\Generator as Faker;

$factory->define(QuestionRate::class, function (Faker $faker) {

    return [
        'order' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
