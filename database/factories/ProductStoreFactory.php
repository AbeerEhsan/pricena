<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductStore;
use Faker\Generator as Faker;

$factory->define(ProductStore::class, function (Faker $faker) {

    return [
        'product_id' => $faker->randomElement(\App\Models\Product::all()->pluck('id')->toArray()),
        'store_id' => $faker->randomElement(\App\Models\Store::all()->pluck('id')->toArray()),
        'price' => $faker->randomDigitNotNull,
        'currency' => $faker->word,
        'deliveryPrice' => $faker->randomDigitNotNull,
        'discount' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
//        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
