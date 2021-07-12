<?php

namespace App\Http\Controllers\Store;

use App\DataTables\ProductDataTable;
use App\DataTables\StoreProductDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\MobileToken;
use App\Models\UsePriceNotification;
use App\Repositories\ProductRepository;
use App\Traits\Notification;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductLang;
use App\Models\ProductStore;
use App\Models\Store;
use Dotenv\Validator;
use Response;
use Auth;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    use Notification;
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param StoreProductDataTable $productDataTable
     * @return Response
     */
    public function index(StoreProductDataTable $storeProductDataTable)
    {
       
        return $storeProductDataTable->render('store_products.index');

      
    }

    
    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $stores= Store::all();
        $categories = Category::where('parent_id','!=', null)->get();
        return view('store_products.create',compact('categories','stores'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        // dd($request);

        $input = $request->all();
        $file = $request->file('img');
        if($request->hasFile('img')){
            $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->img->move(public_path('/uploads/images/products'), $filename);
               $input['img']= 'products/'. $filename;
        }
        else{
            \Session::flash('msg','e:You must select Store Image');
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
            $input ['gallery'] = 'products/'. $name;
        }
        }
/////////////////////////////////////////////////////////////////////////////////////////


        $product_lan1 = ProductLang::create([
            'product_id' =>$product->id ,
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

          $product_store = ProductStore::create([
            'product_id' => $product->id,
            'price' => $request['price'],
            'currency' => $request['currency'],
            'discount'    => $request['discount'],
            'deliveryPrice' => $request['deliveryPrice'],
            'store_id' => Store::where('user_id',Auth::user()->id)->first()->id,
          ]);


  



         Flash::success('Product saved successfully.');

        return redirect(route('storeProducts.index'));

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
            Flash::error('Product not found');

            return redirect(route('storeProducts.index'));
        }

        return view('store_products.show',compact('product'));
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

        $categories = Category::where('parent_id','!=', null)->get();
        $product = $this->productRepository->find($id);
       
        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('storeProducts.index'));
        }

        return view('store_products.edit',compact('product','categories'));
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
        // dd($request);

        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('storeProducts.index'));
        }



////////////////////////////////////////////////////////////////////
        $oldimg = $product->img;
        $input = $request->all();
        $file = $request->file('img');
        if(!empty($file)){
               $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->img->move(public_path('/uploads/images/products'), $filename);
               $input['img']= 'products/'. $filename;
       }else{
               $input['img']=$oldimg;
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
          $input ['gallery'] = 'products/'. $name;
      }
      }

////////////////////////////////////////////////////////////////////////////////////////////////////////
          
        if($request->hasAny('description_en','name_en')){
            $product_lan1=ProductLang::where('product_id','=',$product->id)->where('lang_id','=','1')->first();
            $product_lan1->update([
                'product_id' =>$product->id ,
                'lang_id' => '1',
                'name'    => $request['name_en'],
                'description' => $request['description_en'],
             ]);

            }

        if($request->hasAny('description_ar','name_ar')){
        $category_lan2=ProductLang::where('product_id','=',$product->id)->where('lang_id','=','2')->first();
        $category_lan2->update([
            'product_id' =>$product->id ,
            'lang_id' => '2',
            'name'    => $request['name_ar'],
            'description' => $request['description_ar'],
             ]);
            }

        if($request->hasAny('price','currency','discount','deliveryPrice')){
        $product_store=ProductStore::where('product_id','=',$product->id)->where('store_id','=', Store::where('user_id',Auth::user()->id)->first()->id)->first();
        $product_store->update([
            'product_id' => $product->id,
            'price' => $request['price'],
            'currency' => $request['currency'],
            'discount'    => $request['discount'],
            'deliveryPrice' => $request['deliveryPrice'],
            'store_id' => Store::where('user_id',Auth::user()->id)->first()->id,
                ]);

            //send notification when product less
            $products_price_users=UsePriceNotification::where('product_id',$product_store->product_id)
                ->where('price','>=',$product_store->price)->pluck('user_id')->toArray();

            foreach ($products_price_users as $products_price_user) {
                $tokens = MobileToken::where('user_id', $products_price_user)->pluck('exponent_push_token')->toArray();
                $this->mobileNotify($tokens, $product_store->store_id, $product_store->price, __('settings.api.price_notify') . " " . $product_store->price, $product_store->product_id);
            }
            }

        $product = $this->productRepository->update($input, $id);


        Flash::success('Product updated successfully.');

        return redirect(route('storeProducts.index'));
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
            Flash::error('Product not found');

            return redirect(route('storeProducts.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('storeProducts.index'));
    }
}
