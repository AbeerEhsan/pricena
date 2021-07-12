<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


$factory->define(Category::class, function (Faker $faker) {


    return [
        'img' =>$faker->image('public/uploads/images/categories',150,150,null,false),
        'parent_id' => $faker->randomElement(App\Models\Category::pluck('id')),
        // 'parent_id' => $faker->randomElement(App\Models\Category::pluck('id')),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});

// $faker = Faker::create();

        // DB::table('categories')->truncate();

        // $categoryIds = DB::table('categories')->lists('id');
        // $data = [];

        // for($i=0; $i<50; $i++) {

        //     $randomizedCategoryIds = $categoryIds;

        //     shuffle($randomizedCategoryIds);

        //     $data[] = [
        //         'img' =>$faker->image('public/uploads/images/categories',150,150,null,false),
        //         'parent_id' => array_shift($randomizedCategoryIds),
        //         'created_at' => $faker->date('Y-m-d H:i:s'),
        //         'updated_at' => $faker->date('Y-m-d H:i:s')
                  
        //         ];
        // }

        // DB::table('categories')->insert($data); 
// });