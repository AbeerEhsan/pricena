<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Favourite;
use Faker\Generator as Faker;

$factory->define(Favourite::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomElement(\App\Models\User::all()->pluck('id')->toArray()),
        'rating' => $faker->word,
        'store_id' => $faker->randomElement(\App\Models\Store::all()->pluck('id')->toArray()),
        'product_id' => $faker->randomElement(\App\Models\Product::all()->pluck('id')->toArray()),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
