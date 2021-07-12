<?php

namespace App\Http\Controllers;

use App\DataTables\StoreDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Repositories\StoreRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\City;
use App\Models\Language;
use App\Models\Store;
use App\Models\StoreLang;
use App\Models\User;
use Illuminate\Http\Request;
use Response;

class StoreController extends AppBaseController
{
    /** @var  StoreRepository */
    private $storeRepository;

    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepository = $storeRepo;
    }

    /**
     * Display a listing of the Store.
     *
     * @param StoreDataTable $storeDataTable
     * @return Response
     */
    public function index(StoreDataTable $storeDataTable)
    {
        $languages = Language::all();
        return $storeDataTable->render('stores.index',compact('languages'));
    }

    /**
     * Show the form for creating a new Store.
     *
     * @return Response
     */
    public function create()
    {
        $cities=City::all();
        $users=User::where('type','store')->get();
        return view('stores.create', compact('cities','users'));
    }

    /**
     * Store a newly created Store in storage.
     *
     * @param CreateStoreRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->img);
        // $photo = '';

        $request->validate([
            'img' => 'required',
            'link' => 'required',
            'name_ar' => 'required',
            'description_ar' => 'required',
            'name_en' => 'required',
            'description_en' => 'required',

            
        ]);


        $input = $request->all();
        $file = $request->file('img');
        if($request->hasFile('img')){
            $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->img->move(public_path('/uploads/images/stores'), $filename);
               $input['img']=$filename;
        }
        else{
            \Session::flash('msg','e:يجب اختيار صورة للمتجر');
            return redirect('/stores/create')->withInput();

        }
        // $request['img'] = $photo;
        // $input = $request->all();


        $store = $this->storeRepository->create($input);

        $token= bin2hex(random_bytes(30)).time().$store->id;
        $store->access_token=$token;
        $store->save();


        $store_lan1 = StoreLang::create([
           'store_id' =>$store->id ,
           'lang_id' => '1',
           'name'    => $request['name_en'],
           'description' => $request['description_en'],
        ]);


        $store_lan2 = StoreLang::create([
            'store_id' => $store->id,
            'lang_id' => '2',
            'name'    => $request['name_ar'],
            'description' => $request['description_ar'],
         ]);

        Flash::success('تم اضافة المتجر بنجاح');

        return redirect(route('stores.index'));
    }

    /**
     * Display the specified Store.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $store = $this->storeRepository->find($id);
        if (empty($store)) {
            Flash::error('المتجر المطلوب غير متوفر');

            return redirect(route('stores.index'));
        }
        $storeNameAr=$store->storeLangs->where('lang_id','=','2')->first()->name;
        $storeNameEn=$store->storeLangs->where('lang_id','=','1')->first()->name;
        $storeDescAr=$store->storeLangs->where('lang_id','=','2')->first()->description;
        $storeDescEn=$store->storeLangs->where('lang_id','=','1')->first()->description;

     

        return view('stores.show', compact('store','storeNameAr','storeNameEn','storeDescAr','storeDescEn'));
    }

    /**
     * Show the form for editing the specified Store.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $users=User::where('type','store')->get();
        $cities=City::all();
        $store = $this->storeRepository->find($id);
        if (empty($store)) {
            Flash::error('المتجر المطلوب غير متوفر');

            return redirect(route('stores.index'));
        }
        $storeNameAr=$store->storeLangs->where('lang_id','=','2')->first()->name;
        $storeNameEn=$store->storeLangs->where('lang_id','=','1')->first()->name;
        $storeDescAr=$store->storeLangs->where('lang_id','=','2')->first()->description;
        $storeDescEn=$store->storeLangs->where('lang_id','=','1')->first()->description;
      

        return view('stores.edit' , compact('store','cities','users','storeNameAr','storeNameEn','storeDescAr','storeDescEn'));
    }

    /**
     * Update the specified Store in storage.
     *
     * @param  int              $id
     * @param UpdateStoreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStoreRequest $request)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error('المتجر المطلوب غير متوفر');

            return redirect(route('stores.index'));
        }


        // if($request->hasFile('photo')){
        //     $photo = basename($request->photo->store('public/uploads/images/stores'));
        //     $request['img'] = $photo;
        // }
        $oldimg = $store->img;
        $input = $request->all();
        $file = $request->file('img');
        if(!empty($file)){
               $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->img->move(public_path('/uploads/images/stores'), $filename);
               $input['img']=$filename;
       }else{
               $input['img']=$oldimg;
       }

        if($request->hasAny('description_en','name_en')){
            $store_lan1=StoreLang::where('store_id','=',$store->id)->where('lang_id','=','1')->first();
            $store_lan1->update([
                'store_id' =>$store->id ,
                'lang_id' => '1',
                'name'    => $request['name_en'],
                'description' => $request['description_en'],
             ]);

            }

        if($request->hasAny('description_ar','name_ar')){
        $store_lan2=StoreLang::where('store_id','=',$store->id)->where('lang_id','=','2')->first();
        $store_lan2->update([
            'store_id' =>$store->id ,
            'lang_id' => '2',
            'name'    => $request['name_ar'],
            'description' => $request['description_ar'],
             ]);
            }

        $store = $this->storeRepository->update($input, $id);

        Flash::success('تم التعديل على المتجر بنجاح');

        return redirect(route('stores.index'));
    }

    /**
     * Remove the specified Store from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error('المتجر المطلوب غير متوفر');

            return redirect(route('stores.index'));
        }

        $this->storeRepository->delete($id);

        Flash::success('تم حذف المتجر بنجاح');

        return redirect(route('stores.index'));
    }
}
