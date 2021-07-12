<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\MainCategoryResource;
use App\Http\Resources\OfferExternalResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\PrductsDetailsExternalResource;
use App\Http\Resources\PrductsDetailsResource;
use App\Http\Resources\ProductsResource;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductLang;
use App\Models\ProductStore;
use App\Models\Store;
use Illuminate\Http\Request;
use Validator;
use Exception;

class ExternalStoreApiController extends AppBaseController
{

    //
    function checkToken(Request $request)
    {
        $store=Store::where('access_token',$request->access_token)->first();
        if(isset($store))
        {
           return true ;
        }

        return false ;
    }

    function products(Request $request)
    {
        $store=Store::where('access_token',$request->access_token)->first();

        $products_store=ProductStore::where('store_id',$store->id)->pluck('product_id');

        $query=Product::whereIn('id',$products_store)->orderBy('id','ASC');

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
            'products'=> PrductsDetailsExternalResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');
    }

    function allProducts(Request $request)
    {
        $query=Product::orderBy('created_at','DESC');

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
            'products'=> PrductsDetailsExternalResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');
    }

    function getProductsSubCategories(Request $request , $id)
    {
        setLang($request);

        $query=Product::where('category_id',$id);

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 6;
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

    function offers(Request $request)
    {
        $store=Store::where('access_token',$request->access_token)->first();
        $query=Offer::where('store_id',$store->id)->orderBy('id','ASC');

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
            'offers'=> OfferExternalResource::collection($offers),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');
    }

    function productDetails(Request $request , $id)
    {
        setLang($request);

        $store=Store::where('access_token',$request->access_token)->first();

        $products_store=ProductStore::where('store_id',$store->id)
                                    ->where('product_id',$id)->pluck('product_id');

        $product=Product::whereIn('id',$products_store)->first();
        if(isset($product)) {
            $product=PrductsDetailsExternalResource::make($product);

            return $this->sendResponse($product, 'Successfully');
        }
        return $this->sendError("not found", 403);

    }

    function addProduct(Request $request)
    {
        try {
            setLang($request);

            $rules = [
                'name_ar' => 'required|min:3|max:100',
                'name_en' => 'required|min:3|max:100',
                'description_en' => 'required|min:3|max:250',
                'description_ar' => 'required|min:3|max:250',
                'category_id' => 'required|exists:categories,id',
                'barcode' => 'required|min:3|max:100',
                'sku' => 'required|min:2|max:100',
                'link' => 'required|min:3|max:100',
                'main_image' => 'required',
                'price' => 'required|numeric',
                'discount' => 'nullable|numeric',
                'deliveryPrice' => 'nullable|numeric',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return response()->json(['status' => false, 'message' => 'Error', 'errors' => $this->ValidateService($validator)]);


            $product = Product::create([
                'category_id' => $request['category_id'],
                'Barcode' => $request['barcode'],
                'link' => $request['link'],
                'sku' => $request['sku'],
                'img' => $this->upload($request['main_image'], 'photo', 'products'),
            ]);

            ProductLang::create([
                'product_id' => $product->id,
                'lang_id' => '1',
                'name' => $request['name_en'],
                'description' => $request['description_en'],
            ]);

            ProductLang::create([
                'product_id' => $product->id,
                'lang_id' => '2',
                'name' => $request['name_ar'],
                'description' => $request['description_ar'],
            ]);

            $store = Store::where('access_token', $request->access_token)->first();

            ProductStore::create([
                'product_id' => $product->id,
                'price' => $request['price'],
                'currency' => $request['currency'],
                'discount' => $request['discount'],
                'deliveryPrice' => $request['deliveryPrice'],
                'store_id' => $store->id,
            ]);

            $files = $request['images'];
            if(isset($files))
            foreach ($files as $file) {
                ProductGallery::create([
                    'product_id' => $product->id,
                    'img' => $this->upload($file, 'photo', 'products'),
                ]);
            }

            if (isset($product)) {
                $product = PrductsDetailsExternalResource::make($product);

                return $this->sendResponse($product, 'Added Successfully');
            }
        }
        catch (Exception $exception) {
//            return $exception->getMessage();
            return $this->sendError("Error occur", 403);
        }
    }

    function editProduct(Request $request ,$id)
    {
        try {
            setLang($request);

            $rules = [
                'name_ar' => 'required|min:3|max:100',
                'name_en' => 'required|min:3|max:100',
                'description_en' => 'required|min:3|max:250',
                'description_ar' => 'required|min:3|max:250',
                'category_id' => 'required|exists:categories,id',
                'barcode' => 'required|min:3|max:100',
                'sku' => 'required|min:2|max:100',
                'link' => 'required|min:3|max:100',
                'price' => 'required|numeric',
                'discount' => 'nullable|numeric',
                'deliveryPrice' => 'nullable|numeric',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return response()->json(['status' => false, 'message' => 'Error', 'errors' => $this->ValidateService($validator)]);

            $store = Store::where('access_token', $request->access_token)->first();

            $store_product=ProductStore::where('product_id',$id)->where('store_id',$store->id)->first();
            if(isset($store_product)) {
                $product=Product::find($id);

                $input=[
                    'category_id' => $request['category_id'],
                    'Barcode' => $request['barcode'],
                    'link' => $request['link'],
                    'sku' => $request['sku'],
                ];

                if($request->hasFile($request['img']))
                {
                    $input['img']= $this->upload($request['main_image'], 'photo', 'products');

                }
                $product->update($input);

                $pro_lan1=ProductLang::where('product_id',$product->id)->where('lang_id','1')->first();

                $pro_lan1->update([
                    'name' => $request['name_en'],
                    'description' => $request['description_en'],
                ]);

                $pro_lan2=ProductLang::where('product_id',$product->id)->where('lang_id','2')->first();
                $pro_lan2->update([
                    'name' => $request['name_ar'],
                    'description' => $request['description_ar'],
                ]);


                $store_product->update([
                    'price' => $request['price'],
                    'discount' => $request['discount'],
                    'deliveryPrice' => $request['deliveryPrice'],
                ]);


                $files = $request['images'];
                if (isset($files)) {
                    $old_photos=ProductGallery::where('product_id',$product->id)->get();
                    foreach ($old_photos as $photo)
                        $photo->delete();

                    foreach ($files as $file) {
                        ProductGallery::create([
                            'product_id' => $product->id,
                            'img' => $this->upload($file, 'photo', 'products'),
                        ]);
                    }
                }

                if (isset($product)) {
                    $product = PrductsDetailsExternalResource::make($product);

                    return $this->sendResponse($product, 'Added Successfully');
                }
            }
        }
        catch (Exception $exception) {
//            return $exception->getMessage();
            return $this->sendError("Error occur", 403);
        }
    }

    function deleteProduct(Request $request ,$id)
    {

        $store = Store::where('access_token', $request->access_token)->first();
        $store_product = ProductStore::where('product_id', $id)->where('store_id', $store->id)->first();

        if(isset($store_product)) {
            $product = Product::find($id);

            if (empty($product)) {
                return $this->sendError("not found", 403);
            }

            $product->delete();
            return $this->sendResponse([], 'Successfully');

        }
        return $this->sendError("not found", 403);

    }

    function addOffer(Request $request)
    {
        try {
            setLang($request);

            $rules = [
                'product_id' => 'required|exists:products,id',
                'discount' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return response()->json(['status' => false, 'message' => 'Error', 'errors' => $this->ValidateService($validator)]);

            $store = Store::where('access_token', $request->access_token)->first();
            $store_product=ProductStore::where('product_id',$request['product_id'])->where('store_id',$store->id)->first();

            if (isset($store_product)) {
                $offer=Offer::create(['product_id'=>$request['product_id'],
                    'store_id'=>$store->id,
                    'discount'=>$request['discount'],
                ]);
                $product = OfferExternalResource::make($offer);

                return $this->sendResponse($product, 'Added Successfully');
            }
            return $this->sendError("not found", 403);

        }
        catch (Exception $exception) {
//            return $exception->getMessage();
            return $this->sendError("Error occur", 403);
        }
    }

    function editOffer(Request $request,$id)
    {
        try {
            setLang($request);

            $rules = [
                'product_id' => 'required|exists:products,id',
                'discount' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return response()->json(['status' => false, 'message' => 'Error', 'errors' => $this->ValidateService($validator)]);

            $store = Store::where('access_token', $request->access_token)->first();
            $offer=Offer::where('id',$id)->where('store_id',$store->id)->first();

            if (isset($offer)) {
                $offer->update([
                    'product_id'=>$request['product_id'],
                    'discount'=>$request['discount']]);
                $offer = OfferExternalResource::make($offer);

                return $this->sendResponse($offer, 'Updated Successfully');
            }
            return $this->sendError("not found", 403);

        }
        catch (Exception $exception) {
//            return $exception->getMessage();
            return $this->sendError("Error occur", 403);
        }
    }

    function deleteOffer(Request $request ,$id)
    {

        $store = Store::where('access_token', $request->access_token)->first();
        $store_offer = Offer::where('id', $id)->where('store_id', $store->id)->first();

        if(isset($store_offer)) {
            $offer = Offer::find($id);

            if (empty($offer)) {
                return $this->sendError("not found", 403);
            }

            $offer->delete();
            return $this->sendResponse([], 'Successfully');

        }
        return $this->sendError("not found", 403);

    }

    function categories(Request $request)
    {
        $store=Store::where('access_token',$request->access_token)->first();
        $query=Category::orderBy('id','ASC');

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $categories=$query->paginate($perPage);
            $nextPage=$categories->nextPageUrl();
        }
        else
        {
            $categories = $query->get();
            $nextPage=null;
        }

        $response = [
            'categories'=> MainCategoryResource::collection($categories),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');
    }

}
