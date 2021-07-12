<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id ,
            'comment'=>$this->description ,
            'mobile'=>$this->mobile ,
            'order_number'=>$this->order_number ,
            'rate'=>$this->rate ,
            'store'=>StoreResource::make($this->store) ,
            'product'=>ProductsResource::make($this->product) ,
        ];
    }
}
