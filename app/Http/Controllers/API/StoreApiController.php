<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\FavouriteResource;
use App\Http\Resources\StoreResource;
use App\Models\Favourite;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;

class StoreApiController extends AppBaseController
{
    //
    public function addFavouriteStore(Request $request)
    {
        setLang($request);

        $rules=['store_id'=>'required|exists:stores,id'];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $favourite=Favourite::where('user_id',Auth::id())->where('store_id',$request->store_id)->first();
        if(isset($favourite)) {
            $favourite->delete();
            $message=__('settings.api.favourite_delete');
        }
        else {
            $favourite = Favourite::create(['user_id' => Auth::id(), 'store_id' => $request->store_id]);
            $message=__('settings.api.favourite_create');
        }

        return $this->sendResponse(FavouriteResource::make($favourite), $message);

    }

    public function stores(Request $request)
    {
        setLang($request);

        $query=Store::orderBy('created_at','ASC');

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 6;
            $stores=$query->paginate($perPage);
            $nextPage=$stores->nextPageUrl();
        }
        else
        {
            $stores = $query->get();
            $nextPage=null;
        }

        $response = [
            'stores'=> StoreResource::collection($stores),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

}
