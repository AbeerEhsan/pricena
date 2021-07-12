<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductGallery;
use Faker\Generator as Faker;

$factory->define(ProductGallery::class, function (Faker $faker) {

    return [
        'product_id' => $faker->randomElement(\App\Models\Product::all()->pluck('id')->toArray()),
        'video' => $faker->url,
        'img' => $faker->image('public/uploads/images/',150,150,null,false),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
