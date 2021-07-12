<?php

namespace App\Http\Resources;

use App\Models\Favourite;
use App\Models\ProductLang;
use App\Models\ProductPriceHistory;
use App\Models\ProductStore;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PrductsDetailsResource extends JsonResource
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

        $price=null;
        if(isset($product_store)) {
            $price=$product_store->price;
        }

        $details=$product_lang->details;

        $images=ProductGalleryResource::collection($this->productGalleries);

        $fav=null;
        if(Auth::guard('api')->check())
            $fav=Favourite::where('user_id',Auth::guard('api')->id())->where('product_id',$this->id)->first();

        $is_favourite=isset($fav)? true : false;


        $history_prices_dates_x=ProductPriceHistory::where('product_id',$this->id)->orderBy('created_at','ASC')->pluck('date')->toArray();
        $history_prices_prices_y=ProductPriceHistory::where('product_id',$this->id)->orderBy('created_at','ASC')->pluck('price')->toArray();

        $product_stores=ProductStore::where('product_id',$this->id)->get();

        return [
            'id'=>$this->id ,
            'name'=>$product_lang->name ,
            'category_id'=>$this->category_id ,
            'price'=>$price ,
            'description'=>$product_lang->description ,
            'is_favourite'=>$is_favourite ,
            'main_image'=>url('uploads/images/'.$this->img) ,
            'images'=>$images ,
            'details'=>json_decode($details) ,
            'prices_details_chart'=>[
                'x_axis_dates'=>  $history_prices_dates_x  ,
                'y_axis_prices'=> $history_prices_prices_y ,
            ] ,
            'stores'=>ProductStoreResource::collection($product_stores) ,

//            'stores'=>ProductStoreResource::collection($product_stores) ,
        ];
    }
}
