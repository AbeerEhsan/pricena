<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'=>$this->name ,
            'email'=>$this->email ,
            'is_notify'=>($this->is_notify)?1:0,
            'image'=>url('uploads/images/users/'.$this->img) ,
            'country'=>CountryResource::make($this->country) ,
            'categories'=>UserCategoryResource::collection(($this->categories))
        ];
    }
}
