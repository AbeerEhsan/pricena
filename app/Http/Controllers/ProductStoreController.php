<?php

namespace App\Http\Controllers;

use App\DataTables\ProductStoreDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductStoreRequest;
use App\Http\Requests\UpdateProductStoreRequest;
use App\Models\MobileToken;
use App\Models\UsePriceNotification;
use App\Repositories\ProductStoreRepository;
use App\Traits\Notification;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Product;
use App\Models\ProductStore;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Response;

class ProductStoreController extends AppBaseController
{
    /** @var  ProductStoreRepository */
    private $productStoreRepository;

    use Notification;
    public function __construct(ProductStoreRepository $productStoreRepo)
    {
        $this->productStoreRepository = $productStoreRepo;
    }

    /**
     * Display a listing of the ProductStore.
     *
     * @param ProductStoreDataTable $productStoreDataTable
     * @return Response
     */
    public function index(ProductStoreDataTable $productStoreDataTable, $id )
    {
        $productId=Product::find($id);
        return $productStoreDataTable->render('product_stores.index',compact('productId'));
    }

    /**
     * Show the form for creating a new ProductStore.
     *
     * @return Response
     */
    public function create($id)
    {
        $stores= Store::all();
        $product=Product::find($id);
        return view('product_stores.create',compact('product','stores'));
    }

    /**
     * Store a newly created ProductStore in storage.
     *
     * @param CreateProductStoreRequest $request
     *
     * @return Response
     */
    public function store(CreateProductStoreRequest $request)
    {
        $input = $request->all();

        $deliveryPrice= $request->price - (($request->discount / 100)* $request->price ) ;

        $input['deliveryPrice'] = $deliveryPrice;

        $productStore = $this->productStoreRepository->create($input);
        Flash::success('تم اضافة الشركة بنجاح');

        return redirect(route('productStore.index', $productStore->product_id));
    }

    /**
     * Display the specified ProductStore.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productStore = $this->productStoreRepository->find($id);

        if (empty($productStore)) {
            Flash::error('Product Store not found');

            return redirect(route('productStores.index'));
        }

        return view('product_stores.show')->with('productStore', $productStore);
    }

    /**
     * Show the form for editing the specified ProductStore.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $stores= Store::all();
        $productStore = $this->productStoreRepository->find($id);
        $product = Product::find($productStore->product_id);
        if (empty($productStore)) {
            Flash::error('الشركة غير متوفرة ');

            return redirect(route('productStores.index'));
        }

        return view('product_stores.edit',compact('stores','productStore','product'));
    }

    /**
     * Update the specified ProductStore in storage.
     *
     * @param  int              $id
     * @param UpdateProductStoreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductStoreRequest $request)
    {
        $productStore = $this->productStoreRepository->find($id);

        if (empty($productStore)) {
            Flash::error('الشركة غير متوفرة');

            return redirect(route('productStores.index'));
        }

        $input = $request->all();

        $deliveryPrice = $request->price - (($request->discount / 100) * $request->price);

        $input['deliveryPrice'] = $deliveryPrice;


        $productStore = $this->productStoreRepository->update($input, $id);

        Flash::success('تم تعديل بيانات الشركة بنجاح');

        //send notification when product less
        $products_price_users=UsePriceNotification::where('product_id',$productStore->product_id)
            ->where('price','>=',$productStore->price)->pluck('user_id')->toArray();

        foreach ($products_price_users as $products_price_user) {
            $tokens = MobileToken::where('user_id', $products_price_user)->pluck('exponent_push_token')->toArray();
            $this->mobileNotify($tokens, $productStore->store_id, $productStore->price, __('settings.api.price_notify') . " " . $productStore->price, $productStore->product_id);
        }

        return redirect(route('productStore.index', $productStore->product_id));
    }
    /**
     * Remove the specified ProductStore from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productStore = ProductStore::find($id);

        if (empty($productStore)) {
            Flash::error('الشركة غير موجودة');

            return redirect(route('products.index'));
        }

        $productStore->delete($id);

        Flash::success('تم حذف الشركة بنجاح');

        return redirect(route('productStore.index', $productStore->product_id));
    }
}
