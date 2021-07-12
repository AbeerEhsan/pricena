<?php

use App\Models\CategoryLanguage;
use App\Models\ProductLang;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        // $this->call(StoreTableSeeder::class);
        // $this->call(StoreLangTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(CategoryLanguageTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(ProductLanguageTableSeeder::class);
        // // $this->call(ProductStoreTableSeeder::class);
        // $this->call(ProductGalleryTableSeeder::class);
        // $this->call(FavouriteTableSeeder::class);
        // $this->call(QuestionTableSeeder::class);
        // $this->call(AnswersTableSeeder::class);
        // $this->call(OfferTableSeeder::class);
        // $this->call(CobonsTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(SliderLanguageTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(QuestionRateSeeder::class);
        $this->call(TipAppSliderSeeder::class);
        // $this->call(NewsTableSeeder::class);
        // $this->call(NewsLangTableSeeder::class);
        $this->call(AdvSeeder::class);


        
    }
}
