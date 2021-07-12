<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductStore;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product_store=ProductStore::where('product_id',$this->product_id)
            ->where('store_id',$this->store_id)
            ->first();

        return [
            'store_id'=> $product_store->store_id ,
            'product_id'=> $product_store->product_id ,
            'store'=> StoreResource::make($product_store->store) ,
            'product'=>ProductsResource::make($product_store->product),
            'price'=> $this->price ,
            'discount'=>$this->discount
        ];
    }
}
