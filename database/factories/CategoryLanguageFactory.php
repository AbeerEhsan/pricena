<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryLanguage;
use Faker\Generator as Faker;

$factory->define(CategoryLanguage::class, function (Faker $faker) {

    return [
        'category_id' => $faker->randomElement(\App\Models\Category::all()->pluck('id')->toArray()),
        'name' => $faker->word,
        'lang_id' => $faker->randomElement(\App\Models\Language::all()->pluck('id')->toArray()),
        'description' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
