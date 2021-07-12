<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {

    return [
        'question_id' => $faker->randomElement(\App\Models\Question::all()->pluck('id')->toArray()),
        'answer' => $faker->text,
        'lang_id' => $faker->randomElement(\App\Models\Language::all()->pluck('id')->toArray()),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
