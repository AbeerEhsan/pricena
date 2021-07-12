<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdvResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CoupnResource;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\NewsResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\StoreResource;
use App\Http\Resources\TipAppSliderResource;
use App\Models\Adv;
use App\Models\Cobon;
use App\Models\Country;
use App\Models\Language;
use App\Models\News;
use App\Models\Product;
use App\Models\ProductPriceHistory;
use App\Models\Rate;
use App\Models\Store;
use App\Models\TipAppSlider;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeApiController extends AppBaseController
{

    public function tipAppSlider()
    {
        $tips=TipAppSlider::all();
        return $this->sendResponse( TipAppSliderResource::collection($tips), 'Successfully');


    }

    public function home(Request $request)
    {
        setLang($request);
        $products_interested=[];

        $main_products =Product::where('is_main',1)->take(6)->get();
        $stores=Store::take(6)->get();

        if(Auth::guard('api')->check()) {
            $user_category_ids = UserCategory::where('user_id', Auth::guard('api')->id())->pluck('category_id')->toArray();
            $products_interested = Product::whereIn('category_id', $user_category_ids)->take(6)->get();
        }

        $products_rates=Rate::orderBy('rate','DESC')->pluck('product_id')->toArray();
        $products_more_rates=Product::whereIn('id',$products_rates)->take(6)->get();

        $products_more_visit=Product::orderBy('visits','DESC')->take(6)->get();
        $coupns=Cobon::orderBy('created_at','DESC')->take(6)->get();

        $advs = Adv::orderBy('created_at','DESC')->get();

        $latest_news=News::orderBy('created_at','DESC')->take(6)->get();

        $products=Product::where('is_main',1)->orderBy('created_at','DESC')->take(6)->get();

        $comparisons_ids=ProductPriceHistory::orderBy('created_at','DESC')->pluck('product_id');
        $products_comparison=Product::whereIn('id',$comparisons_ids)->take(6)->get();
        $response=[
            'main_products'=>ProductsResource::collection($main_products) ,
            'stores'=>StoreResource::collection($stores) ,
            'products_slider'=>ProductsResource::collection($products) ,
            'products_interested'=>ProductsResource::collection($products_interested ),
            'products_more_rate'=>ProductsResource::collection($products_more_rates ),
            'products_more_visit'=>ProductsResource::collection($products_more_visit) ,
            'products_comparisons'=>ProductsResource::collection($products_comparison) ,
            'coupns'=>CoupnResource::collection($coupns) ,
            'adv'=>AdvResource::collection($advs) ,
            'news'=>NewsResource::collection($latest_news) ,
        ];

        return $this->sendResponse( $response, 'Successfully');


    }

    public function languages()
    {
        $langs=Language::all();
        return $this->sendResponse( LanguageResource::collection($langs), 'Successfully');

    }

    public function countries(Request $request)
    {
        $query=Country::orderBy('id','ASC');

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $offers=$query->paginate($perPage);
            $nextPage=$offers->nextPageUrl();
        }
        else
        {
            $offers = $query->get();
            $nextPage=null;
        }

        $response = [
            'countries'=> CountryResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');
    }

    public function searchCountries(Request $request)
    {
        $query=Country::where('official_name_en', 'LIKE', "%{$request->text}%")->
                        orwhere('official_name_ar', 'LIKE', "%{$request->text}%");

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $offers=$query->paginate($perPage);
            $nextPage=$offers->nextPageUrl();
        }
        else
        {
            $offers = $query->get();
            $nextPage=null;
        }

        $response = [
            'countries'=> CountryResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');
    }

    public function news(Request $request)
    {

        $query=News::orderBy('created_at','DESC');

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $offers=$query->paginate($perPage);
            $nextPage=$offers->nextPageUrl();
        }
        else
        {
            $offers = $query->get();
            $nextPage=null;
        }

        $response = [
            'countries'=> NewsResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');
    }

    public function newsDetails($id)
    {

        $news=News::find($id);
        return $this->sendResponse(NewsResource::make($news) , 'Successfully');
    }

}
