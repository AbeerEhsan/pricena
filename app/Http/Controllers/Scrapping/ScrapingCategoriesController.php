<?php namespace App\Http\Controllers\Scrapping;


use App\Models\Category;
use App\Models\CategoryLanguage;
use Illuminate\Support\Facades\DB;

Class ScrapingCategoriesController extends BaseScraper
{
    /**
     * To Scrap The Categories page section
     * @return string
     */
    public function scrapCategory() {
        ini_set('max_execution_time', 0);

        // $collection = 'price-comparison-dubai-uae' ;  // all categories url..
        $collection = 'price-comparison-saudi-arabia' ;  // all categories url..

        $rows = Category::count();

        // // re-scrap just when empty!
        // if ($rows > 1) {
        //     DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //     Category::truncate();
        //     CategoryLanguage::truncate();
        //     DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // }

        if ($this->defaultLang == 'en') {
            $crawler = $this->client->request('GET',
                $this->sourceUrl . '/' . $this->defaultLang . '/' . $collection);

            $crawler->filter('.col-3 .box')->each(function ($node) { // ul li
                    $name = $node->filter('a')->text();
                    $slug = $node->attr('id');
                    $path = $node->filter('a')->attr('href');

                    // Top Main Categories..
                    $category = Category::create([
                        //'name' => $name,
                        'parent_id' => 0,
                    ]);
                    $category->categoryLanguage()->create([
                        'name' => $name,
                        'slug' => html_entity_decode($slug),
                        'url' => $path,
                        'lang_id' => $this->getDefaultLanguage(),
                   ]);

                    $node->filter('div > ul > li')->each(function ($node, $i) use ($category) {
                                $name = $node->filter('a')->text();
                                $slug = $node->attr('id');
                                $path = $node->filter('a')->attr('href');

                                if ($node->children()->count() != 3) {
                                    // Top Main Categories..
                                    $sub_category = Category::firstOrCreate([
                                        // 'name' => $name,
                                        'parent_id' => $category->id,
                                    ]);

                                    $sub_category->categoryLanguage()->create([
                                        'name' => $name,
                                        'slug' => html_entity_decode($slug),
                                        'url' => $path,
                                        'lang_id' => $this->getDefaultLanguage(),
                                    ]);
                                }
                                else{
                                    $sub_category = Category::create([
                                        // 'name' => $name,
                                        'parent_id' => $category->id,
                                    ]);

                                    $sub_category->categoryLanguage()->create([
                                        'name' => $name,
                                        'slug' => html_entity_decode($slug),
                                        'url' => $path,
                                        'lang_id' => $this->getDefaultLanguage(),
                                    ]);

                                    $node->children()->filter('ul li')->each(function ($node, $i) use ($sub_category) {
                                        $name = $node->filter('a')->text();
                                        $slug = $node->attr('id');
                                        $path = $node->filter('a')->attr('href');

                                        $sub1_category = Category::create([
                                            // 'name' => $name,
                                            'parent_id' => $sub_category->id
                                        ]);

                                        $sub1_category->categoryLanguage()->create([
                                            'name' => $name,
                                            'slug' => html_entity_decode($slug),
                                            'url' => $path,
                                            'lang_id' => $this->getDefaultLanguage(),
                                        ]);
                                    });
                                }
                    });
                });
        } else {
                $crawler = $this->client->request('GET',
                    $this->sourceUrl . '/' . $this->defaultLang . '/' . $collection);

//         $crawler->filter('.col-3')->each(function ($node) {
                $crawler->filter('.col-3 .box ul li')->each(function ($node, $i) {

                    $name = $node->filter('a')->text();
                    $slug = $node->attr('id');
                    $path = $node->filter('a')->attr('href');

                    // to adjust arabic translation with its related english one.. so there is a missing arabic categories
                    if ($i <= 150) {
                        $count = $i + 1;
                    } elseif ($i > 351 && $i < 595) {
                        $count = $i + 3;
                    } elseif ($i > 595 && $i < 743) {
                        $count = $i + 4;
                    } elseif ($i >= 743) {
                        $count = $i + 5;
                    } else {
                        $count = $i + 2;
                    }

                    Category::find( $count )->categoryLanguage()->create([
                        'name' => htmlentities($name),
                        'slug' => htmlentities($slug),
                        'url' => htmlentities($path),
                        'lang_id' => $this->getDefaultLanguage(),
                    ]);
                });
//         });
        }

//        return 'done';

      return "<h2>There is a ". $rows . ' Categories is DB, to re-scraping the table please truncate it manually.</h2>';
    }

    /**
     * To Counter the number of products in certain Category and its pages (pagination) numbers..
     * @return string
     */
    public function setCategoryCount()
    {
        ini_set('max_execution_time', 0); // 0 = Unlimited

        $categories = Category::with('categoryLanguage')->get();

        foreach ($categories as $category) {

            $collection = $category->categoryLanguage()
                ->where('lang_id', $this->getDefaultLanguage())->pluck('url')->first();

            $crawler = $this->client->request('GET', $this->sourceUrl. '/' . $this->defaultLang . $collection  );

            $pageSize = $crawler->filter('#pageSize')->attr('value'); // default = 40

            $totalProducts = $crawler->filter('#total')->attr('value');

            $count = ceil( $totalProducts/$pageSize );

            $category->update([
                'pageCount' => $count,
                'productCount' => $totalProducts
            ]);
        }
        return 'done';
    }
}
