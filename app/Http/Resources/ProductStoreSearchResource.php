<?php

namespace App\Http\Resources;

use App\Models\Favourite;
use App\Models\ProductLang;
use App\Models\ProductStore;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductStoreSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $fav=Favourite::where('user_id',Auth::id())->where('product_id',$this->product_id)->first();

        $is_favourite=isset($fav)? true : false;

        $lang_id=setLang($request);

        $product_lang=ProductLang::where('product_id',$this->product_id)->where('lang_id',$lang_id)->first();

        $product_stores=ProductStore::where('product_id',$this->id)->get();

        return [
            'id'=>$this->product_id ,
            'name'=>$product_lang->name ,
            'category_id'=>$this->product->category_id ,
            'store_id'=>$this->store_id ,
            'image'=>url('uploads/images/'.$this->product->img) ,
            'price'=>$this->price ,
            'is_favourite'=>$is_favourite ,
            'stores'=>ProductStoreResource::collection($product_stores) ,

        ];
    }
}
