<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cobon;
use Faker\Generator as Faker;

$factory->define(Cobon::class, function (Faker $faker) {

    return [
        'code' => $faker->ean8,
        'maxUser' => $faker->randomDigitNotNull,
        'product_id' => $faker->randomElement(\App\Models\Product::all()->pluck('id')->toArray()),
        'store_id' => $faker->randomElement(\App\Models\Store::all()->pluck('id')->toArray()),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
