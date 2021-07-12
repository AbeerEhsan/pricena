<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductLang;
use App\Models\ProductStore;
use App\Models\Store;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Response;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('products.index');
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $stores = Store::all();
        $categories = Category::where('parent_id', '!=', null)->get();
        return view('products.create', compact('categories', 'stores'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        dd($request);
        // return $request;
        $request->validate([
            'img' => 'required',
            'category_id' => 'required',
            'link' => 'required',
            'sku' => 'required',
            'Barcode' => 'required', 
            'name_ar' => 'required',
            'description_ar' => 'required',
            'name_en' => 'required',
            'description_en' => 'required',
        ]);

        $input = $request->all();
        $file = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            request()->img->move(public_path('/uploads/images/products'), $filename);
            $input['img'] = 'products/'. $filename;
        } else {
            \Session::flash('msg', 'e:يجب اختيار صورة للمنتج ');
            return redirect('/products/create')->withInput();
        }


        $product = $this->productRepository->create($input);

/////////////////////////////Store Multi Image For Product///////////////////////////
     
        $photos = $request->file('gallery');
        if($request->hasFile('gallery')){

        foreach ($photos as $photo) {
        $name = time(). $photo->getClientOriginalName();
        $photo->move(public_path('/uploads/images/products'), $name);
        $productImage = ProductGallery::create(['product_id'=>$product->id,'img'=>$name]);
        $input ['gallery'] = 'products/'.  $name;
        }
        }
/////////////////////////////////////////////////////////////////////////////////////////


        $product_lan1 = ProductLang::create([
            'product_id' => $product->id,
            'lang_id' => '1',
            'name'    => $request['name_en'],
            'description' => $request['description_en'],
        ]);


        $product_lan2 = ProductLang::create([
            'product_id' => $product->id,
            'lang_id' => '2',
            'name'    => $request['name_ar'],
            'description' => $request['description_ar'],
        ]);


         
        // return $request->all();


        // if ($request->ajax()) {
        //     $rules = array(
        //         'store_id.*'  => 'required',
        //         'price.*'  => 'required',
        //         'currency.*'  => 'required',
        //         'deliveryPrice.*'  => 'required',
        //         'discount.*'  => 'required'
        //     );
        //     $error = Validator::make($request->all(), $rules);
        //     if ($error->fails()) {
        //         return response()->json([
        //             'error'  => $error->errors()->all()
        //         ]);
        //     }



        //     for ($count = 0; $count < count($store_id); $count++) {
        //         $data = array(
        //             'product_id' => $product_id[$count],
        //             'store_id' => $store_id[$count],
        //             'price'  => $price[$count],
        //             'currency'  => $currency[$count],
        //             'deliveryPrice'  => $deliveryPrice[$count],
        //             'discount'  => $discount[$count]
        //         );

        //         $insert_data[] = $data;
        //     }

        //     ProductStore::insert($insert_data);
        //     return response()->json([
        //         'success'  => 'Data Added successfully.'
        //     ]);
        //}



        Flash::success('تم اضافة منتج بنجاح ');

        return redirect(route('products.index'));
    }





    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('المنتج غير متوفر');

            return redirect(route('products.index'));
        }
        $productNameAr = $product->productLangs->where('lang_id', '=', '2')->first()->name;
        $productNameEn = $product->productLangs->where('lang_id', '=', '1')->first()->name;
        $productDescAr = $product->productLangs->where('lang_id', '=', '2')->first()->description;
        $productDescEn = $product->productLangs->where('lang_id', '=', '1')->first()->description;


        return view('products.show', compact(
            'product',
            'productNameAr',
            'productNameEn',
            'productDescAr',
            'productDescEn'
        ));
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $categories = Category::where('parent_id', '!=', null)->get();
        $product = $this->productRepository->find($id);
        if (empty($product)) {
            Flash::error('المنتج غير متوفر');

            return redirect(route('products.index'));
        }
        $productNameAr = $product->productLangs->where('lang_id', '=', '2')->first()->name;
        $productNameEn = $product->productLangs->where('lang_id', '=', '1')->first()->name;
        $productDescAr = $product->productLangs->where('lang_id', '=', '2')->first()->description;
        $productDescEn = $product->productLangs->where('lang_id', '=', '1')->first()->description;


        

        return view('products.edit', compact(
            'product',
            'categories',
            'productNameAr',
            'productNameEn',
            'productDescAr',
            'productDescEn'
        ));
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('المنتج غير متوفر');

            return redirect(route('products.index'));
        }


        $oldimg = $product->img;
        $input = $request->all();
        $file = $request->file('img');
        if (!empty($file)) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            request()->img->move(public_path('/uploads/images/products'), $filename);
            $input['img'] = 'products/'. $filename;
        } else {
            $input['img'] = $oldimg;
        }


/////////Edit Multi Image For Product//////////////////////////////////////////////////////////////////
    
        $oldImg=$product->productGalleries->pluck('img');
        $diff= $oldImg->diff($request->galleries);
        //$product->productGalleries->whereIn('img',$diff);
        foreach( $product->productGalleries->whereIn('img',$diff) as $prod) {
            $prod->delete();

        }            

        $photos = $request->file('gallery');

        if($request->hasFile('gallery')){
        foreach ($photos as $photo) {
        $name = time(). $photo->getClientOriginalName();
        $photo->move(public_path('/uploads/images/products'), $name);
        $productImage = ProductGallery::create(['product_id'=>$product->id,'img'=>$name]);
        $input ['gallery'] =  'products/'. $name;
        }
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////



        if ($request->hasAny('description_en', 'name_en')) {
            $product_lan1 = ProductLang::where('product_id', '=', $product->id)->where('lang_id', '=', '1')->first();
            $product_lan1->update([
                'product_id' => $product->id,
                'lang_id' => '1',
                'name'    => $request['name_en'],
                'description' => $request['description_en'],
            ]);
        }

        if ($request->hasAny('description_ar', 'name_ar')) {
            $category_lan2 = ProductLang::where('product_id', '=', $product->id)->where('lang_id', '=', '2')->first();
            $category_lan2->update([
                'product_id' => $product->id,
                'lang_id' => '2',
                'name'    => $request['name_ar'],
                'description' => $request['description_ar'],
            ]);
        }

        $product = $this->productRepository->update($input, $id);

        Flash::success('تم تعديل المنتج بنجاح');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('المنتج غير متوفر');

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('تم حذف المنتج بنجاح');

        return redirect(route('products.index'));
    }
}
