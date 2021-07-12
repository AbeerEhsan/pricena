<?php

use Illuminate\Database\Seeder;

class UpdateStoreTokens extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $stores=\App\Models\Store::all();
        foreach ($stores as $store)
        {
            $token= bin2hex(random_bytes(30)).time().$store->id;
            $store->access_token=$token;
            $store->save();
        }
    }
}
