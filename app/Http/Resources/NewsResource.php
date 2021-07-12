<?php

namespace App\Http\Resources;

use App\Models\NewsLang;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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

        $news_lang=NewsLang::where('new_id',$this->id)->where('lang_id',$lang_id)->first();

        return [
            'id'=>$this->id ,
            'title'=>$news_lang->title ,
            'description'=>$news_lang->description ,
            'image'=>url('uploads/images/news/'.$this->image) ,
        ];
    }
}
