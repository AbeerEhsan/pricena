<?php namespace App\Http\Controllers\Scrapping;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Goutte\Client;

Class BaseScraper extends Controller {

    protected $sourceUrl;

    // protected $defaultLang = 'en'; //ar
    protected $defaultLang; //ar

    protected $client;

    protected $siteCountry; // default ae

    /**
     * Initiate Scraper Fields..
     * BaseScraper constructor.
     */
    public function __construct()
    {
        $this->defaultLang = env('SCRAPER_LOCALIZATION', 'en');
        $this->siteCountry = env('SCRAPER_COUNTRY', 'sa'); 

        $this->sourceUrl = 'https://'.$this->siteCountry.'.pricena.com';

        $this->client = new Client();
    }

    /**
     * Upload images helper with unique file names..
     * @param $imagePath
     * @param $folderName
     * @return string
     */
    protected function uploadImage($imagePath, $folderName){
        try {
            //code...
            $contents = file_get_contents($imagePath);

            $ext = substr ($imagePath, -4);

            $fileName = md5($imagePath . time()) . $ext;

            $path = $folderName . '/' . $fileName;

    //        $name = uniqid('img_') . '.' . $ext;

            \Storage::put($path, $contents);

            return $path;
        } catch (Exception $e) {
            return null;
        }
        return null;
    }

    /**
     * get translated field corresponds for default locale
     * @param $field
     * @return string
     */
    protected function fieldLocale($field)
    {
        return $field . '_' . $this->defaultLang;
    }

    /**
     * return corresponds Language ID in DB..
     * @param $locale
     * @return mixed
     */
    protected function getDefaultLanguage()
    {
        return Language::where('symbol', $this->defaultLang)
            ->pluck('id')
            ->first();
    }
}
