<?php

namespace App\Http\Resources;

use App\Models\Rate;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $store=Store::find($this->store_id);

        return
            [
                'store_id'=> $this->store_id ,
                'store'=> StoreResource::make($store) ,
                'price'=> $this->price ,

            ];
    }
}
