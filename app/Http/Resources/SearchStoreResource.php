<?php

namespace App\Http\Resources;

use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchStoreResource extends JsonResource
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
            'id'=>$this->store->id ,
            'name'=>$this->name ,
            'description'=>$this->description ,
            'link'=>$this->store->link ,
            'image'=>url('uploads/images/stores/'.$this->store->img) ,
        ];
    }
}
