<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvResource extends JsonResource
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
            'type'=> $this->type ,
            'media_link'=> isset($this->media_link)? url('uploads/images/adv/'.$this->media_link) : null,
            'link'=>$this->link
        ];
    }
}
