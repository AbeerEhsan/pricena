<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;


class scrapingController extends Controller{

    // view page
    public function index(Request $request){
        return view('scrapping.index');
    }

    public function getPrice(Request $request){
        // $url = 'https://www.noon.com/saudi-en/';
        $request->validate([
            'link'=>'required',
        ]);
        // $dom = HtmlDomParser::file_get_html( $request->link );
        $dom = HtmlDomParser::file_get_html( $request->link  , $use_include_path = false, $context=null, $offset = 0);
        try {
            $title = $dom->find('.primaryDetails .coreWrapper h1',0)->innertext;
            $price = $dom->find('.primaryDetails .sellingPrice .value',0)->innertext;
            $currency = $dom->find('.primaryDetails .sellingPrice .currency',0)->innertext;
            $image = $dom->find('.primaryDetails .imageGalleryWrapper .mediaContainer img.pdpImage',0)->src;
            $data=[
                "title" => $title,
                "price" => $price,
                "currency" => $currency,
                "image" => $image,
                "url" => $request->link
            ];
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Error at detection'], 500);
        }
        return response()->json(['data'=>$data,'message'=>'successfully detection'], 200);
    }

    public function getPriceGet(Request $request){
        $url = 'https://www.noon.com/saudi-en/official-shemagh-ms1000-red-white/N19655586V/p?o=a45fd594ddf8348e';
        $prices= [];
        // define('MAX_FILE_SIZE', 90000000);
        // $str = file_get_contents($url);
        // $html = HtmlDomParser::str_get_html($str);

        $dom = HtmlDomParser::file_get_html( $url , $use_include_path = false, $context=null, $offset = 0);
        // $dom = HtmlDomParser::file_get_html( $html , $use_include_path = false, $context=null, $offset = 0);
       try {
           $title = $dom->find('.primaryDetails .coreWrapper h1',0)->innertext;
           $price = $dom->find('.primaryDetails .sellingPrice .value',0)->innertext;
           $currency = $dom->find('.primaryDetails .sellingPrice .currency',0)->innertext;
           $image = $dom->find('.primaryDetails .imageGalleryWrapper .mediaContainer img.pdpImage',0)->src;
        //    $text = $dom->find('p.pdpImage',0)->innertext;
           //  .imageGalleryWrapper .swiper-slide img
        //    dump($title);
        //    dump($price);
        //    dump($currency);
        //    dump($image);
            //    dump($text);
            $data=[
                "title" => $title,
                "price" => $price,
                "currency" => $currency,
                "image" => $image
            ];
        // $text
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Error at detection'], 500);
        }
        return response()->json(['data'=>$data,'message'=>'successfully detection'], 200);
        // $i=0;
        // foreach ($elms as $price) {
        //     dump($price->innertext );
        // }
        //     if ($i > 10) {
        //             break;
        //     }

        //     // Find item link element
        //     $priceDetails = $price->find('.value', 0);
        //     $priceCurrency = $price->find('.currency', 0);

        //     // get title attribute
        //     $priceTitle = $priceDetails->title;

        //     // push to a list of prices
        //     $prices[] = [
        //             'title' => $priceTitle,
        //             'currency'=>$priceCurrency,
        //             'url' => $url
        //     ];

        //     $i++;
        // }
        // // return response()->json([ 'prices'=>$price], 200);
        // return [ 'prices'=>$price];
        return '';
    }
}
