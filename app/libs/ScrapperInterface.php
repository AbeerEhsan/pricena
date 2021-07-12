<?php

namespace App\libs\Scrapper;
interface ScrapperInterface {
    public function getAllCategories($language = 'en');
    public function getAllProductsAtCategory($category,$language = 'en');
    public function getProductDetails($product,$language = 'en');
    public function getSearchResultProduct($query, $language = 'en');
    // public function run();
    // public function updatePrice($link);
}
