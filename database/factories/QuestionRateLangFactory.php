<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QuestionRateLang;
use Faker\Generator as Faker;

$factory->define(QuestionRateLang::class, function (Faker $faker) {

    return [
        'question' => $faker->word,
        'question_id' => $faker->word,
        'lang_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
