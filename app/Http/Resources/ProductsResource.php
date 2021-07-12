<?php

namespace App\Http\Resources;

use App\Models\Favourite;
use App\Models\ProductLang;
use App\Models\ProductStore;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductsResource extends JsonResource
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

        $product_lang=ProductLang::where('product_id',$this->id)->where('lang_id',$lang_id)->first();

        $product_store=ProductStore::where('product_id',$this->id)->orderBy('price','ASC')->first();

        $fav=null;
        if(Auth::guard('api')->check())
        $fav=Favourite::where('user_id',Auth::guard('api')->id())->where('product_id',$this->id)->first();

        $is_favourite=isset($fav)? true : false;

        $store=null;
        $price=null;
        if(isset($product_store)) {
//            $store = Store::find($product_store->store_id);
            $price=$product_store->price;
        }

        $product_stores=ProductStore::where('product_id',$this->id)->get();

        return [
            'id'=>$this->id ,
            'name'=>$product_lang->name ,
            'category_id'=>$this->category_id ,
            'image'=>url('uploads/images/'.$this->img) ,
            'price'=>$price ,
            'description'=>$product_lang->description ,
            'is_favourite'=>$is_favourite ,
            'stores'=>ProductStoreResource::collection($product_stores) ,

        ];
    }
}
