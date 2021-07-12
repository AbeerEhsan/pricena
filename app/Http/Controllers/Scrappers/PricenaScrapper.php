<?php

namespace App\Http\Controllers\Scrappers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\libs\Scrapper\ScrapperInterface;
use Sunra\PhpSimple\HtmlDomParser;
use App\Http\Controllers\Scrappers\ScrapperController;


class PricenaScrapper extends ScrapperController implements ScrapperInterface{

    public static $baseLink = "https://sa.pricena.com/";
    public static $languages = ['ar', 'en'];

    public function getAllCategories($language = 'en'){
        // return parent::getName();
        $langLink_ar = self::$baseLink . self::$languages[0];
        $langLink_en = self::$baseLink . self::$languages[1];
        $link = $langLink_ar. '/price-comparison-saudi-arabia';
        $link_en = $langLink_en. '/price-comparison-saudi-arabia';
        try {
            $context = stream_context_create(
                array(
                    "http" => array(
                        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                    )
                )
            );
            $dom = HtmlDomParser::file_get_html( $link, $use_include_path = false, $context, $offset = 0);
            $dom_en = HtmlDomParser::file_get_html( $link_en, $use_include_path = false, $context, $offset = 0);
            if(!$dom || !$dom_en){
                return response()->json(['message'=>'Error at get page content'], 400);
            }

            $boxs = $dom->find('.box');
            // dd($boxs[0]->find('.title a'));
            $boxs_en = $dom_en->find('.box');

            if(!$boxs || !$boxs_en){
                return response()->json(['message'=>'Error at get page content'], 400);
            }
            foreach ($boxs as $key => $box) {
                $title = $box->find('.title a')[0]->innertext();
                $list = $box->find('div > ul > li > a');
                $list_en = $boxs_en[$key]->find('div > ul > li > a');

                $title_en = $boxs_en[$key]->find('.title a')[0]->innertext();
                // dd($title_en);

                foreach ($list as $i => $item) {
                    // dd($item);
                    $node['dom'] = $item;
                    $node['title'] = trim($item->innertext());
                    $node['link_ar'] = $langLink_ar . $item->getAttribute('href');
                    $node['link_en'] = $langLink_en . $list_en[$i]->getAttribute('href');
                    $node['ar']['name'] = trim($item->innertext());
                    $node['en']['name'] = trim($title_en);
                    $items[] = $node;

                    $parent = $item->parent->find('ul');
                    if( count($parent)){
                        dd(count($parent), $parent[0]->children[0]);
                        // dd($parent->find('> a')[0]->innertext(),
                        //     $parent->find('ul')[0]->innertext());
                        // $item->parent->find('ul')->innertext()
                        dd($i, $item->parent,
                            $item->parent->find('ul')?
                                $item->parent->find('> a')[0]->innertext(): '');
                        // ->innertext()
                        // if($item->parent->find('ul')){
                        //     // dd($item->parent->find('ul')->innertext());
                        // }
                        // dd($i, $item->parent, $item->parent->find('ul')? 'found': '');
                    }
                }
                // dd($title, $items);
                dd($list);
            }

            // [
            //     'parent_id' => null,
            //     'image' => "url",
            //     "ar"=>[
            //         "name" => "",
            //         "description" => ""
            //     ],
            //     "en"=>[
            //         "name" => "",
            //         "description" => ""
            //     ]
            // ]

            // $titlesText  = [];
            // foreach ($titles as $title) {
            //     $titlesText[] =  $title->innertext();
            // }
            // return $titlesText;
            // return $title;
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

        // next Page of products
        // document.querySelectorAll('.nextPage a')[0].href

        return "";
    }

    public function getProductDetails($product,$language = 'en'){
        return "";
    }

    public function getSearchResultProduct($query, $language = 'en'){
        return "";
    }


}
