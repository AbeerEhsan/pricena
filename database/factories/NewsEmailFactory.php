<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\NewsEmail;

use Faker\Generator as Faker;

$factory->define(NewsEmail::class, function (Faker $faker) {
    return [
        'email'=>$faker->email
    ];
});
