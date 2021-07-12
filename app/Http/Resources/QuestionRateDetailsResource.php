<?php

namespace App\Http\Resources;

use App\Models\QuestionRateAnswer;
use App\Models\QuestionRateAnswerLang;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionRateDetailsResource extends JsonResource
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

        $answers=QuestionRateAnswer::where('question_id',$this->question_id)->pluck('id');

        $answers_lang=QuestionRateAnswerLang::whereIn('answer_id',$answers)->where('lang_id',$lang_id)->get();

        return [
            'id'=>$this->id ,
            'question'=>$this->question ,
            'answers'=>QuestionRateAnswersResource::collection($answers_lang)
        ];
    }
}
