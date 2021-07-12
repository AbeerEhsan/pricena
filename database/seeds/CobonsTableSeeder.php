<?php

use Illuminate\Database\Seeder;

class CobonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Cobon::class,8)->create();
        factory(App\Models\CobonProduct::class,20)->create();
    }
}
