<?php

namespace App\Http\Controllers\Scrappers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\libs\Scrapper\ScrapperInterface;
use Sunra\PhpSimple\HtmlDomParser;
use App\Http\Controllers\Scrappers\ScrapperController;

class JarirScrapper extends ScrapperController implements ScrapperInterface{

    // public $baseLink = "https://www.google.ps/?";
    // public $baseLink = "https://www.jarir.com/";
    public $baseLink = "https://sa.pricena.com/ar/";

    public function getAllCategories($language = 'en'){
        return parent::getName();
        // $link = self::$baseLink . '';
        $link = self::$baseLink . 'price-comparison-saudi-arabia';
        // $link = "https://stackoverflow.com/questions/7260966/php-simple-html-dom-parser-500-server-error";
        // return $link;
        // document.querySelectorAll('#all-categories .list .list--parent')[0].children[0];
        try {
            $context = stream_context_create(
                array(
                    "http" => array(
                        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                    )
                )
            );
            // $dom = HtmlDomParser::file_get_html( "https://www.google.ps/?gws_rd=ssl", $use_include_path = false, $context=null, $offset = 0);
            // $dom = HtmlDomParser::file_get_html( "https://www.jarir.com/#all-categories", $use_include_path = false, $context=null, $offset = 0);
            $dom = HtmlDomParser::file_get_html( $link, $use_include_path = false, $context, $offset = 0);
            // $dom = HtmlDomParser::file_get_html( $link );
            // $dom = HtmlDomParser::file_get_html( "https://www.google.ps/?");
            // $dom = HtmlDomParser::file_get_html( $link , $use_include_path = false, $context=null, $offset = 0);
            // dd($dom);
            if(!$dom){
                return response()->json(['message'=>'Error at get page content'], 500);
            }

            $titles = $dom->find('.title a');
            // $title = $dom->find('#all-categories .list .list--parent');
            // $title = $dom->find('#all-categories .list .list--parent')[0]->plaintext;
            // dd($titles);
            $titlesText  = [];
            foreach ($titles as $title) {
                $titlesText[] =  $title->innertext();
            }
            return $titlesText;
            // dd($title);
            // return $title;
            // $price = $dom->find('.primaryDetails .sellingPrice .value',0)->innertext;
            // $currency = $dom->find('.primaryDetails .sellingPrice .currency',0)->innertext;
            // $image = $dom->find('.primaryDetails .imageGalleryWrapper .mediaContainer img.pdpImage',0)->src;
            // $data=[
            //     "title" => $title,
            //     "price" => $price,
            //     "currency" => $currency,
            //     "image" => $image,
            //     "url" => $link
            // ];

        } catch (\Exception $e) {
            return response()->json(['message'=>'Error at detection', "Error"=> $e->getMessage()], 500);
        }
        return response()->json(['data'=>[]], 200);
        // return response()->json(['data'=>$data,'message'=>'successfully detection'], 200);
    }

    public function getAllProductsAtCategory($category,$language = 'en'){
        return "";
    }

    public function getProductDetails($product,$language = 'en'){
        return "";
    }

    public function getSearchResultProduct($query, $language = 'en'){
        return "";
    }


}
