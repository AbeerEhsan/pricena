<?php

namespace App\Http\Resources;

use App\Models\Rate;
use App\Models\StoreLang;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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

        $store_lang=StoreLang::where('store_id',$this->id)->where('lang_id',$lang_id)->first();

        $rates_sum=Rate::where('store_id',$this->id)->sum('rate');
        $rates_count=Rate::where('store_id',$this->id)->count();
        $rates = 0;
        if($rates_count > 0)
        {
            $rates =   $rates_sum/$rates_count;
        }
        return [
           'id'=>$this->id ,
           'name'=>$store_lang->name ,
           'description'=>$store_lang->description ,
           'rates'=>$rates ,
           'link'=>$this->link ,
           'lat'=>$this->lat ,
           'lng'=>$this->lng ,
           'image'=>url('uploads/images/stores/'.$this->img) ,
        ];
    }
}
