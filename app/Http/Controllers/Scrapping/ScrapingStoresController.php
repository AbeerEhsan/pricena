<?php namespace App\Http\Controllers\Scrapping;
use App\Models\Store;
use App\Models\StoreLang;
use Illuminate\Support\Facades\DB;


Class ScrapingStoresController extends BaseScraper
{
    /**
     * Scrap stores names
     * @return string|true
     */
    public function scrapStores()
    {
        ini_set('max_execution_time', 0);

        $collection = 'stores';

        $rows = Store::count();

        // re-scrap just when empty!
        // if ($rows > 1) {
        //     DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //     Store::truncate();
        //     StoreLang::truncate();
        //     DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // }

        // dd(234);
        
        $crawler = $this->client->request('GET',
            $this->sourceUrl.'/'.$this->defaultLang.'/'.$collection);

        if ($this->defaultLang == 'en') {
            $crawler->filter('.store-data')->each(function ($node) {

                $name = $node->filter('.store-name')->text();
                $style = $node->filter('.store-block .logo')->attr('style');
                $link = $node->filter('.store-block a')->attr('href');

                $imageUrl = $this->extractImageName($style);
                $imagePath = $this->uploadImage($imageUrl, 'stores');

                $store = Store::create([
                        'img' => 'storage/app/' . $imagePath,  // in --> storage_path()
                        'link' => $link,
                ]);

                $store->storeLangs()->create([
                        'name' => $name,
                        'lang_id' => $this->getDefaultLanguage(),
                ]);

//              return print_r($name);
            });

        } else {
            $crawler->filter('.store-data')->each(function ($node, $i) {

                $name = $node->filter('.store-name')->text();

                StoreLang::find($i + 1)->create([
                        'store_id' => $i + 1,
                        'lang_id' => $this->getDefaultLanguage(),
                        'name' => $name,
                ]);
            });
        }
    }

    /**
     * Extract image name from inline style.
     * @param $style
     * @return mixed
     */
    public function extractImageName($style)
    {
        $pattern = '/background-image:\s*url\(\s*([\'"]*)(?P<file>[^\1]+)\1\s*\)/i';

        $matches = array();

        if (preg_match($pattern, $style, $matches)) {
            return $matches['file'];
        }
    }
}
