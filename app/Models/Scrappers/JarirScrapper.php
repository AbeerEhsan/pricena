<?php
namespace App\Models\Scrappers;

// use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use  App\libs\Scrapper\ScrapperInterface;
use App\Models\Scrapper;
use Sunra\PhpSimple\HtmlDomParser;


// implements ScrapperInterface
// extends Model
class JarirScrapper extends Scrapper implements ScrapperInterface {
    public static $baseLink = "https://www.google.ps/?";
    // public static $baseLink = "https://www.jarir.com/";

    public static function getName(){
        return 'Jarir Name';
    }

    public function getAllCategories($language = 'en'){
        // $link = self::$baseLink . '';
        $link = self::$baseLink . '';
        // return $link;
        // document.querySelectorAll('#all-categories .list .list--parent')[0].children[0];
        try {
            // $dom = HtmlDomParser::file_get_html( $link, $use_include_path = false, $context=null, $offset = 0);
            // $dom = HtmlDomParser::file_get_html( $link );
            $dom = HtmlDomParser::file_get_html( $link , $use_include_path = false, $context=null, $offset = 0);

            // $body = $dom->find('body')->innertext;
            // $body = $dom->find('a')[1]->innertext();
            $title = $dom->find('#all-categories .list .list--parent')[0]->children();
            dd($title);
            // dd($body);
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


        } catch (\Throwable $th) {
            return response()->json(['message'=>'Error at detection'], 500);
        }
        return response()->json(['data'=>[]], 200);
        // return response()->json(['data'=>$data,'message'=>'successfully detection'], 200);
    }

    public static function getAllProductsAtCategory($category,$language = 'en'){

    }

    public static function getProductDetails($product,$language = 'en'){

    }

    public static function getSearchResultProduct($query, $language = 'en'){

    }

}
