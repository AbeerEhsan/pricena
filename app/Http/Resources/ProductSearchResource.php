<?php

namespace App\Http\Resources;

use App\Models\Favourite;
use App\Models\ProductStore;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product_store=ProductStore::where('product_id',$this->product_id)->orderBy('price','ASC')->first();

        $fav=Favourite::where('user_id',Auth::id())->where('product_id',$this->product_id)->first();
        $is_favourite=isset($fav)? true : false;

        $store=null;
        $price=null;
        if(isset($product_store)) {
            $store = Store::find($product_store->store_id);
            $price=$product_store->price;
        }

        $product_stores=ProductStore::where('product_id',$this->product->id)->get();

        return [
            'id'=>$this->product->id ,
            'name'=>$this->name ,
            'category_id'=>$this->product->category_id ,
            'image'=>url('uploads/images/'.$this->product->img) ,
            'price'=>$price ,
            'is_favourite'=>$is_favourite ,
            'stores'=>ProductStoreResource::collection($product_stores) ,
            'store'=>StoreResource::make($store) ,
        ];
    }
}
