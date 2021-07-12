<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoupnResource;
use App\Http\Resources\FavouriteResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\PrductsDetailsResource;
use App\Http\Resources\ProductSearchResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\ProductStoreResource;
use App\Http\Resources\ProductStoreSearchResource;
use App\Http\Resources\RateResource;
use App\Http\Resources\SearchHistoryResource;
use App\Http\Resources\SearchStoreResource;
use App\Http\Resources\StoreResource;
use App\Models\Cobon;
use App\Models\CobonProduct;
use App\Models\Favourite;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductLang;
use App\Models\ProductPriceHistory;
use App\Models\ProductStore;
use App\Models\Rate;
use App\Models\SearchHistory;
use App\Models\Store;
use App\Models\StoreLang;
use App\Models\UsePriceNotification;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

class ProductApiController extends AppBaseController
{
    //


    public function productDetails(Request $request , $id)
    {
//        dd(array_search($id, $selection = \Illuminate\Support\Facades\Session::get('visited_products', [])));
////
////        dd(getSession($request));
//        if (!in_array($id, session()->get('visited_products',[]))) {
//            session()->push('visited_products', $id);
//            session()->save();
//            dd(session()->get('visited_products',[]));
//        }
//        dd(Session::all());

        setLang($request);
        $product=Product::find($id);
        if(isset($product)) {
            if (!in_array($id, session()->get('visited_products',[]))) {
                session()->push('visited_products',$id,[]);
                $product->visits += 1;
                $product->save();
            }
            $product=PrductsDetailsResource::make($product);

            return $this->sendResponse($product, 'Successfully');
        }
        return $this->sendError("not found", 403);

    }

    public function productStores(Request $request ,$id)
    {
        $query=ProductStore::where('product_id',$id)->orderBy('created_at','ASC');

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $products=$query->paginate($perPage);
            $nextPage=$products->nextPageUrl();
        }
        else
        {
            $products = $query->get();
            $nextPage=null;
        }

        $response = [
            'stores'=> ProductStoreResource::collection($products),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function productRates(Request $request ,$id)
    {
        $query=Rate::where('product_id',$id)->orderBy('rate','DESC');

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $products=$query->paginate($perPage);
            $nextPage=$products->nextPageUrl();
        }
        else
        {
            $products = $query->get();
            $nextPage=null;
        }

        $response = [
            'stores'=> RateResource::collection($products),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function search(Request $request)
    {
        setLang($request);

        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $response=null;
        $query=null;

        if(isset($request['type'])) {
            switch ($request['type'])
            {
                case 'products': {
                    $text = isset($request['text']) ? $request['text'] : null;
                    $query = ProductLang::where('name', 'LIKE', "%{$text}%")
                        ->orderBy('created_at', 'ASC');

                    $search_history=SearchHistory::where('user_id',Auth::id())
                        ->where('text',$request['text'])->first();

                    if(!isset($search_history))
                    SearchHistory::create([
                        'user_id'=> Auth::id(),
                        'text'=> $request['text'],
                    ]);

                    break;
                }

                case 'barcode': {
                    $barcode = isset($request['text']) ? $request['text'] : null;
                    $query = Product::where('Barcode', $barcode)
                        ->orderBy('created_at', 'ASC');
                    break;

                }
                case 'stores': {
                    $text = isset($request['text']) ? $request['text'] : null;
                    $query = StoreLang::where('name', 'LIKE', "%{$text}%")
                        ->orderBy('created_at', 'ASC');
                    break;

                }
            }


            if (!empty($request['page'])) {
                $perPage = $request->has('offset') ? $request->offset : 10;
                $products = $query->paginate($perPage);
                $nextPage = $products->nextPageUrl();
            } else {
                $products = $query->get();
                $nextPage = null;
            }

            $items=null;

            if($request['type'] == "products")
                $items=ProductSearchResource::collection($products);
            elseif ($request['type'] == "barcode")
                $items= ProductsResource::collection($products);
            elseif ($request['type'] == "stores")
                $items= SearchStoreResource::collection($products);

            $response = [
                'items' => $items,
                'nextPage' => $nextPage
            ];
        }
        return $this->sendResponse($response , 'Successfully');
    }

    public function searchProductsOfStore(Request $request)
    {
        setLang($request);

        $validator = Validator::make($request->all(), [
            'store_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $response=null;
        $query=null;

        if( isset($request['filter']) || isset($request['text'])  ) {

            $filter=isset($request['filter'])? $request['filter'] : 'date_desc';

            if($filter) {
                switch ($filter) {
                    case 'date_desc': {
                        $text = isset($request['text']) ? $request['text'] : null;

                        $products_ids = ProductLang::where('name', 'LIKE', "%{$text}%")->pluck('product_id');

                        $query= ProductStore::where('store_id',$request['store_id'])
                        ->whereIn('product_id',$products_ids)->orderBy('created_at','DESC');

                        break;
                    }
                    case 'date_asc': {
                        $text = isset($request['text']) ? $request['text'] : null;

                        $products_ids = ProductLang::where('name', 'LIKE', "%{$text}%")->pluck('product_id');

                        $query= ProductStore::where('store_id',$request['store_id'])
                        ->whereIn('product_id',$products_ids)->orderBy('created_at','ASC');

                        break;
                    }
                    case 'price_desc': {
                        $text = isset($request['text']) ? $request['text'] : null;

                        $products_ids = ProductLang::where('name', 'LIKE', "%{$text}%")->pluck('product_id');

                        $query= ProductStore::where('store_id',$request['store_id'])
                        ->whereIn('product_id',$products_ids)->orderBy('price','DESC');

                        break;
                    }
                    case 'price_asc': {
                        $text = isset($request['text']) ? $request['text'] : null;

                        $products_ids = ProductLang::where('name', 'LIKE', "%{$text}%")->pluck('product_id');

                        $query= ProductStore::where('store_id',$request['store_id'])
                        ->whereIn('product_id',$products_ids)->orderBy('price','ASC');

                        break;
                    }

                }
            }


            if (!empty($request['page'])) {
                $perPage = $request->has('offset') ? $request->offset : 10;
                $products = $query->paginate($perPage);
                $nextPage = $products->nextPageUrl();
            } else {
                $products = $query->get();
                $nextPage = null;
            }

            $items=null;

            $items=ProductStoreSearchResource::collection($products);

            $response = [
                'items' => $items,
                'nextPage' => $nextPage
            ];
            return $this->sendResponse($response , 'Successfully');

        }
        return $this->sendError(['error' => 'fill filter or text for searching']);

    }

    public function searchHistory()
    {
        $histories=SearchHistory::where('user_id',Auth::id())->limit('5')->get();
        return $this->sendResponse(SearchHistoryResource::collection($histories) , 'Successfully');

    }

    public function deleteSearchHistory(Request $request)
    {
        setLang($request);

        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $history=SearchHistory::find($request->item_id);
        if(isset($history)) {
            $history->delete();
            return $this->sendResponse([], 'Item is deleted Successfully');
        }
        return $this->sendError("item not found", 403);


    }

    public function deleteAllSearchHistory()
    {
        $history=SearchHistory::where('user_id',Auth::id())->get();

        foreach ($history as $item)
            $item->delete();

        return $this->sendResponse([], 'Items is deleted Successfully');

    }

    public function addFavouriteProduct(Request $request)
    {
        setLang($request);

        $rules=['product_id'=>'required|exists:products,id'];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $favourite=Favourite::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();
        if(isset($favourite)) {
            $favourite->delete();
            $message=__('settings.api.favourite_delete');
        }
        else {
            $favourite = Favourite::create(['user_id' => Auth::id(), 'product_id' => $request->product_id]);
            $message=__('settings.api.favourite_create');
        }

        return $this->sendResponse(FavouriteResource::make($favourite), $message);

    }

    public function offers(Request $request)
    {
        $query=Offer::orderBy('created_at','DESC');

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
            'offers'=> OfferResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function addPriceNotification(Request $request)
    {
        setLang($request);

        $rules=[
            'product_id'=>'required|exists:products,id',
            'price'=>'required|min:1'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $notification_price=UsePriceNotification::where('user_id',Auth::id())
            ->where('product_id',$request->product_id)
            ->where('price',$request->price)
            ->first();

        if(isset($notification_price))
                $msg="You requested same notification previously";
            else {
                $notification_price = UsePriceNotification::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'price' => $request->price,
                ]);
                $msg="Added Successfully";
            }
        return $this->sendResponse([] , $msg);

    }

    public function userProductsInterested(Request $request)
    {
        $user_category_ids=UserCategory::where('user_id',Auth::id())->pluck('category_id')->toArray();

        $query=Product::whereIn('category_id',$user_category_ids);

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
            'products'=> ProductsResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function productsMoreViews(Request $request)
    {
        $query=Product::orderBy('visits','DESC');

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
            'products'=> ProductsResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function productsMoreRate(Request $request)
    {
        $products_rates=Rate::orderBy('rate','DESC')->pluck('product_id')->toArray();
        $query=Product::whereIn('id',$products_rates);

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
            'products'=> ProductsResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function productsComparisons(Request $request)
    {
        $comparisons_ids=ProductPriceHistory::orderBy('created_at','DESC')->pluck('product_id');
        $query=Product::whereIn('id',$comparisons_ids)->orderBy('created_at','DESC');

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
            'products'=> ProductsResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function coupns(Request $request)
    {

        $query=Cobon::orderBy('created_at','DESC');

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $cobons=$query->paginate($perPage);
            $nextPage=$cobons->nextPageUrl();
        }
        else
        {
            $cobons = $query->get();
            $nextPage=null;
        }

        $response = [
            'coupns'=> CoupnResource::collection($cobons),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function getStoreProducts(Request $request , $store_id)
    {
        setLang($request);

        $product_ids=ProductStore::where('store_id',$store_id)->pluck('product_id')->toArray();
        $query=Product::whereIn('id',$product_ids);

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $products=$query->paginate($perPage);
            $nextPage=$products->nextPageUrl();
        }
        else
        {
            $products = $query->get();
            $nextPage=null;
        }

        $response = [
            'products'=> ProductsResource::collection($products),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function getCoupnProducts(Request $request , $id)
    {
        setLang($request);

        $product_ids=CobonProduct::where('cobon_id',$id)->pluck('product_id')->toArray();
        $query=Product::whereIn('id',$product_ids);

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $products=$query->paginate($perPage);
            $nextPage=$products->nextPageUrl();
        }
        else
        {
            $products = $query->get();
            $nextPage=null;
        }

        $response = [
            'products'=> ProductsResource::collection($products),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function productsNearbyStores(Request $request , $id)
    {
        setLang($request);

        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 403);
        }

        $store_ids=ProductStore::where('product_id',$id)->pluck('store_id')->toArray();
        $query=Store::whereIn('id',$store_ids);

        $max_distance = 800;

        $gr_circle_radius=1371;
        $lat=$request->lat;
        $lng=$request->lng;

        $distance_select = sprintf(
            "           
                                    ( %d * acos( cos( radians(%s) ) " .
            " * cos( radians(lat) ) " .
            " * cos( radians(lng) - radians(%s) ) " .
            " + sin( radians(%s) ) * sin( radians(lat) ) " .
            " ) " .
            ")
                                     ",
            $gr_circle_radius,
            $lat,
            $lng,
            $lat
        );

        $page= $request->has('page') ? $request->page : 1;

        $perPage = $request->has('offset') ? $request->offset : 10;

        $stores =  $query->select('*')
                ->having(DB::raw($distance_select), '<=', $max_distance)
                ->orderBy(DB::raw($distance_select) , 'ASC')
                ->skip(($page - 1) * $perPage)->limit($perPage)->get();;

        $stores_next =  $query->select('*')
                ->having(DB::raw($distance_select), '<=', $max_distance)
                ->orderBy(DB::raw($distance_select) , 'ASC')
                ->skip((($page+1) - 1) * $perPage)->limit($perPage)->get();


        $offset = $request->has('offset') ? "&offset=". $request->offset  : "";
        $nextPage=isset($stores_next[0]) ? url('api/v1/product/'.$id.'/nearby-stores?page='. ($page+1) . $offset) : null ;

            $response = [
                'stores'=> StoreResource::collection($stores),
                'nextPage' =>  $nextPage
            ];


        return $this->sendResponse( $response, 'تم عرض البيانات بنجاح');

    }




}
