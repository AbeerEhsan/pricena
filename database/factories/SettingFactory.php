<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {

    return [
        'terms' => $faker->text,
        'privacy' => $faker->text,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->email,
        'social' => json_encode([
            'facebook'=>$faker->url,
            'instagram'=>$faker->url,
            'twitter'=>$faker->url
        ]),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
