<?php

namespace App\Http\Controllers\Scrappers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryLanguage;
use Illuminate\Http\Request;


class ScrapperController extends Controller{

    // public static $baseLink = "https://www.google.ps/?";
    // public static $baseLink = "https://www.jarir.com/";
    // public $baseLink = "https://sa.pricena.com/ar/";

    public function getName(){
        return 'Jarir Name';
    }

    public function addCategory($categoryData, $main = null){
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

        if($categoryData->image != null ){
            $imgContents = file_get_contents($categoryData->image);
            // $name = substr($categoryData->image, strrpos($categoryData->image, '/uploads/images/categories') + 1);
            // Storage::put($name, $imgContents);

            $filename = 'category-'.time() . '.' . $imgContents->getClientOriginalExtension();
            $imgContents->move(public_path('/uploads/images/categories'), $filename);
            $categoryData->image = $filename;
        }
        $category = Category::create([
            "img" => $categoryData->image,
            "parent_id" => $main? $main : null
        ]);

        if(!$category){
            return ;
        }

        $categ_lan1 = CategoryLanguage::create([
            'category_id' =>$category->id,
            'lang_id' => '1',
            'name'    => $categoryData['en']['name'],
            'description' => $categoryData['en']['description'],
        ]);
        $categ_lan2 = CategoryLanguage::create([
            'category_id' =>$category->id,
            'lang_id' => '2',
            'name'    => $categoryData['ar']['name'],
            'description' => $categoryData['ar']['description'],
        ]);

        // if(){

        // }

        return true;
    }

}
