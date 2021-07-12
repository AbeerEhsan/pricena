<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QuestionRateAnswerLang;
use Faker\Generator as Faker;

$factory->define(QuestionRateAnswerLang::class, function (Faker $faker) {

    return [
        'answer_id' => $faker->word,
        'lang_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
