<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Adv;
use Faker\Generator as Faker;

$factory->define(Adv::class, function (Faker $faker) {

    return [
        'media_link' => 'adv-1.jpg',
        'type' => 'photo',
        'description' => $faker->text,
        'link' => $faker->word.'.com',
        'is_active' => '0',
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
