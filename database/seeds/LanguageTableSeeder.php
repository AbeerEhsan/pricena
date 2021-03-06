<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Language::create([
            'name'=>'English',
            'symbol'=>'en',
        ]);

        \App\Models\Language::create([
            'name'=>'Arabic',
            'symbol'=>'ar',
        ]);
    }
}
