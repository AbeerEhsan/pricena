<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {

    return [
        'img' => $faker->image('public/uploads/images/stores',150,150,null,false),
        'link' => $faker->url,
        'city_id' => $faker->randomElement(\App\Models\City::all()->pluck('id')->toArray()),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
