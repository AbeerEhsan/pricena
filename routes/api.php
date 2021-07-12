<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {

    Route::post('login', 'AuthController@login');

    Route::post('login/{provider}', 'AuthController@loginSocial');

    Route::post('register', 'AuthController@register');
    Route::get('lang/{lang}', 'AuthController@changeLang');

    Route::get('tips-app-slider', 'HomeApiController@tipAppSlider');


    Route::post('send-verification-code','AuthController@sendVerificationCode');
    Route::post('confirm-verification-code','AuthController@confirmVerificationCode');
    Route::post('change-password','AuthController@changePassword');

    Route::get('home', 'HomeApiController@home');

    Route::get('product/{id}/stores', 'ProductApiController@productStores');
    Route::get('product/{id}/rates', 'ProductApiController@productRates');
    Route::post('product/{id}/nearby-stores', 'ProductApiController@productsNearbyStores');

    Route::get('app/share/product/{id}', function ($id) {
        return view('share', compact('id'));
    })->name('Share');

    Route::get('products-more-views', 'ProductApiController@productsMoreViews');
    Route::get('products-more-rate', 'ProductApiController@productsMoreRate');
    Route::get('products-comparisons', 'ProductApiController@productsComparisons');

    Route::get('stores', 'StoreApiController@stores');

    Route::group([ 'middleware' =>['external']], function() {

        Route::get('store/products', 'ExternalStoreApiController@products');
        Route::get('store/products/{id}', 'ExternalStoreApiController@productDetails');
        Route::post('store/product', 'ExternalStoreApiController@addProduct');
        Route::post('store/product/{id}/edit', 'ExternalStoreApiController@editProduct');
        Route::post('store/product/{id}/delete', 'ExternalStoreApiController@deleteProduct');

        Route::get('store/offers', 'ExternalStoreApiController@offers');
        Route::post('store/offer', 'ExternalStoreApiController@addOffer');
        Route::post('store/offer/{id}/edit', 'ExternalStoreApiController@editOffer');
        Route::post('store/offer/{id}/delete', 'ExternalStoreApiController@deleteOffer');

        Route::get('store/categories', 'ExternalStoreApiController@categories');
        Route::get('store/category/{id}/products', 'ExternalStoreApiController@getProductsSubCategories');

        Route::get('store/all-products', 'ExternalStoreApiController@allProducts');


    });

    Route::group([ 'middleware' =>['sessions']], function() {
        Route::get('product/{id}', 'ProductApiController@productDetails');
    });
    Route::group([ 'middleware' =>['auth:api']], function() {
        Route::post('exponentPushToken', 'AuthController@exponentPushToken');
        Route::get('update-notify', 'AuthController@updateNotify');

        Route::post('app-rate', 'AuthController@appRate');

        Route::get('products-interested', 'ProductApiController@userProductsInterested');

        Route::get('countries', 'HomeApiController@countries');

        Route::get('search-countries', 'HomeApiController@searchCountries');

        Route::post('send-test-notification', 'AuthController@testSendNotifications');

        Route::get('profile', 'AuthController@profile');
        Route::post('update-profile', 'AuthController@updateProfile');

        Route::get('languages', 'HomeApiController@languages');


        Route::get('main-categories', 'CategoryApiController@getMainCategories');
        Route::get('category/{id}/sub-categories', 'CategoryApiController@getSubCategories');
        Route::get('sub-category/{id}/products', 'CategoryApiController@getProductsSubCategories');



        Route::post('favourite-product', 'ProductApiController@addFavouriteProduct');
        Route::post('favourite-store', 'StoreApiController@addFavouriteStore');
        Route::get('favourite', 'AuthController@favouriteList');

        Route::get('rates-list', 'AuthController@ratesList');

        Route::get('notifications-list', 'AuthController@notificationsList');

        Route::post('user-country', 'AuthController@userCountry');
        Route::post('user-categories', 'AuthController@userCategories');



        Route::get('coupns', 'ProductApiController@coupns');

        Route::get('store/{id}/products', 'ProductApiController@getStoreProducts');
        Route::get('coupn/{id}/products', 'ProductApiController@getCoupnProducts');

        Route::get('delete-favourite', 'AuthController@deleteFavourite');

        Route::get('search', 'ProductApiController@search');
        Route::post('search-products-store', 'ProductApiController@searchProductsOfStore');
        Route::get('search-history', 'ProductApiController@searchHistory');
        Route::post('delete-search-history-item', 'ProductApiController@deleteSearchHistory');
        Route::get('delete-all-search-history', 'ProductApiController@deleteAllSearchHistory');

        Route::get('delete-all-notifications', 'AuthController@deleteAllNotification');

        Route::get('offers', 'ProductApiController@offers');

        Route::post('price-notification', 'ProductApiController@addPriceNotification');

        Route::post('logout', 'AuthController@logout');


        Route::get('questions', 'RateApiController@questionsRate');
        Route::post('rate', 'RateApiController@addRate');

        Route::get('news', 'HomeApiController@news');
        Route::get('news/{id}', 'HomeApiController@newsDetails');

    });
});
