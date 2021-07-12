<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Favourite;
use App\Models\ProductLang;
use App\Models\ProductPriceHistory;
use App\Models\ProductStore;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PrductsDetailsExternalResource extends JsonResource
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

        $store = Store::where('access_token', request()->get('access_token'))->first();

        $product_store=ProductStore::where('product_id',$this->id)
            ->where('store_id',$store->id)
            ->first();

        $price=null;
        if(isset($product_store)) {
            $price=$product_store->price;
        }

        $images=ProductGalleryResource::collection($this->productGalleries);

        $categoy=Category::find($this->category_id);
        $cat=isset($categoy) ? MainCategoryResource::make($categoy) : null ;

        $product_stores=ProductStore::where('product_id',$this->id)->get();

        return [
            'id'=>$this->id ,
            'name'=>$product_lang->name ,
            'category_id'=>$this->category_id ,
            'price'=>$price ,
            'description'=>$product_lang->description ,
            'main_image'=>url('uploads/images/'.$this->img) ,
            'images'=>$images ,
            'category'=>$cat,
            'sku'=>$this->sku ,
            'barcode'=>$this->Barcode ,
            'link'=>$this->link ,
            'stores'=>ProductStoreResource::collection($product_stores) ,

        ];
    }
}
