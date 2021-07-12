<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CobonProduct;
use Faker\Generator as Faker;

$factory->define(CobonProduct::class, function (Faker $faker) {

    return [
        'product_id' => $faker->randomElement(\App\Models\Product::all()->pluck('id')->toArray()),
        'cobon_id' => $faker->randomElement(\App\Models\Cobon::all()->pluck('id')->toArray()),
    ];
});
