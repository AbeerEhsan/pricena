<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/stores-api-document', function () {
    return view('doc');
});

// Route::get('dynamic-field', 'DynamicFieldController@index');
// Route::post('dynamic-field/insert', 'ProductController@insert')->name('dynamic-field.insert');
Auth::routes(['verify' => true]);


Route::get('login/{provider}', 'TestController@redirectToProvider');
Route::get('login/{provider}/callback', 'TestController@handleProviderCallback');

Route::middleware(['auth'])->group(function () {

Route::get('/', 'HomeController@index')->middleware('verified');
});
Route::get('/home', 'HomeController@index')->name('dashboard')->middleware('verified');

Route::middleware(['adminType'])->group(function () {

    //override route /users (step 1)
    // to separate types and show it as (store,admin,user at menu view)
    Route::get('users/{type?}/', 'UserController@index')
                ->where(['type' => '^([a-z]+(?<!create))'])
                ->name('users.admins1');

    Route::resource('users', 'UserController');

    Route::resource('products', 'ProductController');

    Route::resource('languages', 'LanguageController');

    Route::resource('countries', 'CountryController');

    Route::resource('cities', 'CityController');

    Route::resource('stores', 'StoreController');

    Route::resource('storeLangs', 'StoreLangController');

    Route::resource('categories', 'CategoryController');

    Route::resource('categoryLanguages', 'CategoryLanguageController');

    Route::get('/productStores/{id}/delete','ProductStoreController@destroy')->name('productStore.index');
    Route::get('/productStores/{id}/create','ProductStoreController@create')->name('productStore.create');
    Route::get('/productStores/{id}/edit/{pid}','ProductStoreController@edit')->name('productStore.edit');

    Route::resource('productLangs', 'ProductLangController');

    Route::resource('productStores', 'ProductStoreController');

    Route::resource('productGalleries', 'ProductGalleryController');

    Route::resource('favourites', 'FavouriteController');

    Route::resource('questions', 'QuestionController');

    Route::resource('answers', 'AnswerController');

    Route::resource('offers', 'OfferController');

    Route::resource('news', 'NewsController');

    Route::resource('cobons', 'CobonsController');

    Route::resource('sliders', 'SliderController');

    Route::resource('sliderLangs', 'SliderLangController');

    Route::resource('settings', 'SettingController');

    Route::resource('questionRates', 'QuestionRatesController');

    Route::resource('questionRateLangs', 'QuestionRateLangController');

    Route::resource('questionRateAnswers', 'QuestionRateAnswerController');

    Route::resource('questionRateAnswerLangs', 'QuestionRateAnswerLangController');

    Route::resource('tipAppSliders', 'TipAppSliderController');

    Route::resource('questionRates', 'QuestionRateController');


    Route::resource('cobonProducts', 'CobonProductController');

    Route::resource('cobonProducts', 'CobonProductController');

    Route::resource('advs', 'AdvController');

// Route::get('scraping', 'scrapingController@index')->name('scraping.index');

    Route::post('notifications', 'NotificationController@store')->name('notification.store');
    Route::get('notifications', 'NotificationController@index')->name('notification.index');

});


Route::post('getPrice', 'scrapingController@getPrice')->name('scraping.getPrice');
Route::get('getPrice', 'scrapingController@getPriceGet');


//////////////////////Store Control panel////////////////////////
Route::namespace('Store')->middleware('storeType')->group(function () {

    Route::resource('storeProducts', 'ProductController');
    Route::resource('storeOffers', 'OfferController');

});


// Route::get('scrappers', function() {
//     // $s = \App\Models\Scrapper::create([
//     //     "website_name" => "Jarir",
//     //     "base_url" => "https://www.jarir.com/",
//     //     "class" => \App\Models\Scrapper::$scrappers["Jarir"],
//     //     "type" => "Main",
//     //     "is_active" => true,
//     //     "is_run" => true
//     // ]);
//     // return $s;
//     $scrappers = \App\Models\Scrapper::all();
//     foreach ($scrappers as $scrapper) {
//         // echo $scrapper->class::getName();
//         echo $scrapper->class::getAllCategories();
//     }
//     // return (new $scrappers[0]->class())->getAllCategories();

// });

// Route::get('scrappers', "Scrappers\JarirScrapper@getAllCategories");
// Route::get('scrappers', "Scrappers\PricenaScrapper@getAllCategories");

Route::get('privacy', 'GuestController@privacy');
Route::get('contact_us', 'GuestController@contact_us');
// Route::get('scrappers', "Scrappers\PricenaScrapper@getAllCategories");

// Scrapper test 
Route::get('scrap/stores', 'Scrapping\ScrapingStoresController@scrapStores');

Route::get('scrap/category', 'Scrapping\ScrapingCategoriesController@scrapCategory');

Route::get('scrap/setCategoryCount', 'Scrapping\ScrapingCategoriesController@setCategoryCount');

Route::get('scrap/product-by-category/{category_id}', 'Scrapping\ScrapingProductsController@scrapProductByCategory');
Route::get('scrap/products-by-category/{skip}-{take}', 'Scrapping\ScrapingProductsController@scrapProductsByCategory');

