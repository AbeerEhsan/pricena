<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StoreLang;
use Faker\Generator as Faker;

$factory->define(StoreLang::class, function (Faker $faker) {

    return [
        'store_id' => $faker->randomElement(\App\Models\Store::all()->pluck('id')->toArray()),
        'lang_id' => $faker->randomElement(\App\Models\Language::all()->pluck('id')->toArray()),
        'name' => $faker->word,
        'description' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
