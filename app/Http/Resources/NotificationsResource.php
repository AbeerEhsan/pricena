<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        setLang($request);

        $data=$this->data;

        if($this->type == 'price_change')
            $data=__('settings.api.price_notify').$this->data;

        elseif($this->type == 'general')
            $data=$this->data;

        return[
           'id'=>$this->id ,
           'data'=>$data ,
           'type'=>$this->type,
           'product'=>ProductsResource::make($this->product) ,
           'store'=>StoreResource::make($this->store) ,
        ];
    }
}
