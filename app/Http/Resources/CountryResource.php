<?php

namespace App\Http\Resources;

use App\Models\Language;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
        $lang=Language::find($lang_id);
        $name=$this->official_name_ar;

        if(isset($lang) && $lang->symbol == "en")
            $name=$this->official_name_en;

        return [
            'id'=>$this->id ,
            'name'=>$name ,
        ];
    }
}
