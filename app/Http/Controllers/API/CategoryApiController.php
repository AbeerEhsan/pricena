<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\MainCategoryResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryApiController extends AppBaseController
{
    //

    public function getMainCategories(Request $request)
    {
        setLang($request);

        $query=Category::whereNull('parent_id');
        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $categories = $query->paginate($perPage);
            $nextPage=$categories->nextPageUrl();
        }
        else
        {
            $categories = $query->get();
            $nextPage=null;
        }

        $response = [
            'categories'=> MainCategoryResource::collection($categories),
            'nextPage'  => $nextPage
        ];
        return $this->sendResponse($response , 'Successfully');


    }

    public function getSubCategories(Request $request , $id)
    {
        setLang($request);

        $query=Category::where('parent_id',$id);

        if (!empty($request['page'])) {
            $perPage = $request->has('offset') ? $request->offset : 10;
            $sub_categories=$query->paginate($perPage);
            $nextPage=$sub_categories->nextPageUrl();
        }
        else
        {
            $sub_categories = $query->get();
            $nextPage=null;
        }

        $response = [
            'categories'=> SubCategoryResource::collection($sub_categories),
            'nextPage' =>$nextPage
        ];
        return $this->sendResponse($response , 'Successfully');

    }

    public function getProductsSubCategories(Request $request , $id)
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


}
