<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'sku' => $faker->ean8,
        'img' => $faker->image('public/uploads/images/',150,150,null,false),
        'category_id' => $faker->randomElement(\App\Models\Category::all()->pluck('id')->toArray()),
        'Barcode' => $faker->ean8,
        'link' => $faker->url,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
