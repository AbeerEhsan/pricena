<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductLang;
use Faker\Generator as Faker;

$factory->define(ProductLang::class, function (Faker $faker) {

    return [
        'product_id' => $faker->randomElement(\App\Models\Product::all()->pluck('id')->toArray()),
        'lang_id' => $faker->randomElement(\App\Models\Language::all()->pluck('id')->toArray()),
        'name' => $faker->word,
        'description' => $faker->text,
        'details' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
