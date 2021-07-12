<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QuestionRateAnswer;
use Faker\Generator as Faker;

$factory->define(QuestionRateAnswer::class, function (Faker $faker) {

    return [
        'question_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
