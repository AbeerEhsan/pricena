<?php

namespace App\Http\Resources;

use App\Models\CategoryLanguage;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang_id=setLang($request);

        $cat_lang=CategoryLanguage::where('category_id',$this->id)->where('lang_id',$lang_id)->first();

        $products = $this->products->take(4);

        return [
            'id'=> $this->id ,
            'name'=>$cat_lang->name ,
            'products'=>ProductsResource::collection($products)
        ];
    }
}
