<?php 
namespace App\Http\Controllers\Scrapping;

use App\Models\Category;
use App\Models\Store;
use App\Models\Product;


Class ScrapingProductsController extends BaseScraper {

    public function scrapProductByCategory($id)
    {
        ini_set('max_execution_time', 0); // 0 = Unlimited

        $category = Category::with('categoryLanguage')->find($id);

        // delete all products to re-scrap new data..
        $category->products()->delete();


        for ($i = 1; $i <= $category->pageCount; $i++) {
                $crawler = $this->client->request('GET',
                    $this->sourceUrl . '/' . $this->defaultLang . $category->categoryLanguage[0]->url .'/page/'. $i);

                $crawler->filter('.item')->each(function ($node, $i) use ($category) {

                    $name = $node->filter('.name h2')->text();
                    $path_in_source = $node->filter('.name h2 a')->attr('href');
//                    $low_price = $node->filter('.price a')->text();

                    // import images
                    $image = $node->filter('.product-thumbnail img')->attr('data-lazy');
                    $imageName = $this->uploadImage($image, 'products');

                    if ($this->defaultLang == 'en') {
                        $product = $category->products()->firstOrCreate([
                            'link' => html_entity_decode($path_in_source),
//                            'low_price' => html_entity_decode($low_price),
                            'img' => $imageName
                        ]);

                        $product->productLangs()->create([
                            'name' => html_entity_decode($name),
                            'lang_id' => $this->getDefaultLanguage(),
                        ]);

                        print_r($name);
                        echo "<br>";

//                        $product->productStores()->delete();

                        $node->filter('.suggested-offer .so-row')->each(function ($node) use ($product) {

                            $storeName = $node->filter('.so-shop .suggested-store-name')->html('0');

                            $price = explode(' ', $node->filter('.so-price .price-val')->text('0'));

                            // get store id from store name
                            $storeId = Store::whereHas('storeLangs', function ($query) use ($storeName) {
                                return $query->where('name', $storeName);
                            })->pluck('id')->first();
                            
                            if(isset($storeId) && !empty($storeId)){
                                $product->productStores()->create([
                                    'store_id' => $storeId,
                                    'price' => $price[0],
                                    'currency' => $price[1]
                                ]);
                            }
                        });
                    } else {
                        Product::where('link', $path_in_source)
                            ->where('category_id', $category->id)->update([
                                $this->fieldLocale('name') => $name
                            ]);
                    }
                });
        }
//        return 'done scrapping all products include in category '. $category->categoryLanguage[0]->name;
    }

    public function scrapProductsByCategory($skip, $take){
        ini_set('max_execution_time', 0); // 0 = Unlimited
        $categories = Category::with('categoryLanguage')->skip($skip)->take($take)->get();
        
        foreach ($categories as $category) {
            if($this->defaultLang == 'en'){
                // delete all products to re-scrap new data..
                $category->products()->delete();
            }


            for ($i = 1; $i <= $category->pageCount; $i++) {
                    $crawler = $this->client->request('GET',
                        $this->sourceUrl . '/' . $this->defaultLang . $category->categoryLanguage[0]->url .'/page/'. $i);

                    $crawler->filter('.item')->each(function ($node, $i) use ($category) {

                        $name = $node->filter('.name h2')->text();
                        $path_in_source = $node->filter('.name h2 a')->attr('href');
    //                    $low_price = $node->filter('.price a')->text();

                        // import images
                        $image = $node->filter('.product-thumbnail img')->attr('data-lazy');
                        try {
                            $imageName = $this->uploadImage($image, 'products');
                        } catch (Excpetion $e) {
                            $imageName = null;
                        }
                        if ($this->defaultLang == 'en') {
                            $product = $category->products()->firstOrCreate([
                                'link' => html_entity_decode($path_in_source),
    //                            'low_price' => html_entity_decode($low_price),
                                'img' => $imageName
                            ]);

                            $product->productLangs()->create([
                                'name' => html_entity_decode($name),
                                'lang_id' => $this->getDefaultLanguage(),
                            ]);

                            print_r($name);
                            echo "<br>";

    //                        $product->productStores()->delete();

                            $node->filter('.suggested-offer .so-row')->each(function ($node) use ($product) {

                                $storeName = $node->filter('.so-shop .suggested-store-name')->html('0');

                                $price = explode(' ', $node->filter('.so-price .price-val')->text('0'));

                                // get store id from store name
                                $storeId = Store::whereHas('storeLangs', function ($query) use ($storeName) {
                                    return $query->where('name', $storeName);
                                })->pluck('id')->first();
                                
                                if(isset($storeId) && !empty($storeId)){
                                    $product->productStores()->create([
                                        'store_id' => $storeId,
                                        'price' => $price[0],
                                        'currency' => $price[1]
                                    ]);
                                }
                            });
                        } else {
                            // Product::where('link', $path_in_source)
                            //     ->where('category_id', $category->id)->update([
                            //         $this->fieldLocale('name') => $name
                            //     ]);

                            $product = $category->products()->where('link' , html_entity_decode($path_in_source))->first();
                            if(isset($product)){
                               $product->productLangs()->updateOrCreate([
                                   'name' => html_entity_decode($name),
                                   'lang_id' => $this->getDefaultLanguage(),
                                ]);
                                print_r($name);
                                echo "<br>";
                            }
                        }
                    });
            }
        }
//        return 'done scrapping all products include in category '. $category->categoryLanguage[0]->name;
    }
}
