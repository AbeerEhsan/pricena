<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {

    return [
        'img' => $faker->image('public/uploads/images/Sliders',150,150,null,false),
        'link' => $faker->url,
        'offer_id' => $faker->randomElement(\App\Models\Offer::all()->pluck('id')->toArray()),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
