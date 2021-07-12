<?php

use Illuminate\Database\Seeder;

class NewsEmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\NewsEmail::class,20)->create();
    }
}
