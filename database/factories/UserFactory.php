<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => $faker->date('Y-m-d H:i:s'),
        'password' => bcrypt('123123'),
        'img'=>'user' . $faker->numberBetween(1, 30) . '.jpg',
        'type' => $faker->randomElement(['admin','store','user','user','user','user','user']),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];

});
