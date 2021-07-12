<?php

use Illuminate\Database\Seeder;

class AdvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Adv::class, 1)->create();

    
    }
}
