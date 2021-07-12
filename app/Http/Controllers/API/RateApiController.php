<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionRateDetailsResource;
use App\Http\Resources\QuestionRateResource;
use App\Http\Resources\RateResource;
use App\Http\Resources\StoreResource;
use App\Models\QuestionRate;
use App\Models\QuestionRateAnswer;
use App\Models\QuestionRateLang;
use App\Models\Rate;
use App\Models\Store;
use App\Models\UserRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RateApiController extends AppBaseController
{
    //

    public function questionsRate(Request $request)
    {
        setLang($request);

        $lang_id=setLang($request);

        $query=QuestionRateLang::where('lang_id',$lang_id);

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 6;
            $questions_rate=$query->paginate($perPage);
            $nextPage=$questions_rate->nextPageUrl();
        }
        else
        {
            $questions_rate = $query->get();
            $nextPage=null;
        }

        $response = [
            'questions'=> QuestionRateDetailsResource::collection($questions_rate),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function addRate(Request $request)
    {
        setLang($request);

        $validator = Validator::make($request->all(), [
            'rate' => 'required|numeric|between:1,5',
            'store_id' => 'required|exists:stores,id',
            'product_id' => 'required|exists:products,id',
            'comment' => 'required',
            'mobile' => 'required',
            'order_number' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $rate=Rate::where('user_id',Auth::id())
            ->where('store_id',$request->store_id)
            ->where('product_id',$request->product_id)
            ->first();

        if(isset($rate))
        {
            $message="You rated this product in this store previously";
            $data=[];
        }
        else
        {
            $rate=Rate::create([
                'user_id'=>Auth::id() ,
                'store_id'=>$request->store_id ,
                'product_id'=>$request->product_id ,
                'description'=>$request->comment ,
                'order_number'=>$request->order_number ,
                'mobile'=>$request->mobile ,
                'rate'=>$request->rate ,
            ]);

            // add answers
            foreach ($request->answers_ids as $answer_id) {
                $answer=QuestionRateAnswer::find($answer_id);
                if(isset($answer))
                UserRate::create(['user_id'=> Auth::id(), 'answer_id'=>$answer_id]);
            }
            $message="Your Rate added Successfully";
            $data=RateResource::make($rate);
        }
        return $this->sendResponse($data , $message);
    }

}
