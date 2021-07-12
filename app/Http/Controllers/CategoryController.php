<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use App\Models\CategoryLanguage;
use Response;
use Illuminate\Http\Request;

class CategoryController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::where('parent_id','=', null)->get();
        return view('categories.create',compact('categories'));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // $photo = '';
        // if($request->hasFile('photo')){
        //     $photo = basename($request->photo->store('public/uploads/images/categories'));
        // }

        $request->validate([
            'img' => 'required',
            'name_ar' => 'required',
            'description_ar' => 'required',
            'name_en' => 'required',
            'description_en' => 'required',


        ]);


        $input = $request->all();
        $file = $request->file('img');
        if($request->hasFile('img')){
            $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->img->move(public_path('/uploads/images/categories'), $filename);
               $input['img']=$filename;
        }

        else{
            \Session::flash('msg','e:You must select Category Image');
            return redirect('/categories/create')->withInput();

        }
        // $request['img'] = $photo;

        // $input = $request->all();

        $category = $this->categoryRepository->create($input);

        $categ_lan1 = CategoryLanguage::create([
            'category_id' =>$category->id ,
            'lang_id' => '1',
            'name'    => $request['name_en'],
            'description' => $request['description_en'],
         ]);


         $categ_lan2 = CategoryLanguage::create([
             'category_id' => $category->id,
             'lang_id' => '2',
             'name'    => $request['name_ar'],
             'description' => $request['description_ar'],
          ]);
        Flash::success('تم اضافة قسم بنجاح');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        if (empty($category)) {
            Flash::error('القسم غير متوفر');

            return redirect(route('categories.index'));
        }

        $categoryNameAr=$category->categoryLanguage->where('lang_id','=','2')->first()->name;
        $categoryNameEn=$category->categoryLanguage->where('lang_id','=','1')->first()->name;
        $categoryDescAr=$category->categoryLanguage->where('lang_id','=','2')->first()->description;
        $categoryDescEn=$category->categoryLanguage->where('lang_id','=','1')->first()->description;


      
        return view('categories.show',compact('category','categoryNameAr'
        ,'categoryNameEn','categoryDescAr' , 'categoryDescEn'));
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        if (empty($category)) {
            Flash::error('القسم غير متوفر');

            return redirect(route('categories.index'));
        }
        $categories = Category::where('parent_id','=', null)->get();

        $categoryNameAr=$category->categoryLanguage->where('lang_id','=','2')->first()->name;
        $categoryNameEn=$category->categoryLanguage->where('lang_id','=','1')->first()->name;
        $categoryDescAr=$category->categoryLanguage->where('lang_id','=','2')->first()->description;
        $categoryDescEn=$category->categoryLanguage->where('lang_id','=','1')->first()->description;

      

        return view('categories.edit',compact('category','categories','categoryNameAr'
        ,'categoryNameEn','categoryDescAr' , 'categoryDescEn'));
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('القسم غير متوفر');

            return redirect(route('categories.index'));
        }

        // if($request->hasFile('photo')){
        //     $photo = basename($request->photo->store('public/uploads/images/categories'));
        //     $request['img'] = $photo;
        // }

        $oldimg = $category->img;
        $input = $request->all();
        $file = $request->file('img');
        if(!empty($file)){
               $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->img->move(public_path('/uploads/images/categories'), $filename);
               $input['img']=$filename;
       }else{
               $input['img']=$oldimg;
       }

        if($request->hasAny('description_en','name_en')){
            $category_lan1=CategoryLanguage::where('category_id','=',$category->id)->where('lang_id','=','1')->first();
            $category_lan1->update([
                'category_id' =>$category->id ,
                'lang_id' => '1',
                'name'    => $request['name_en'],
                'description' => $request['description_en'],
             ]);

            }

        if($request->hasAny('description_ar','name_ar')){
        $category_lan2=CategoryLanguage::where('category_id','=',$category->id)->where('lang_id','=','2')->first();
        $category_lan2->update([
            'category_id' =>$category->id ,
            'lang_id' => '2',
            'name'    => $request['name_ar'],
            'description' => $request['description_ar'],
             ]);
            }



        $category = $this->categoryRepository->update($input, $id);

        Flash::success('تم تعديل القسم بنجاح');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('القسم غير متوفر');

            return redirect(route('categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('تم حذف القسم بنجاح');

        return redirect(route('categories.index'));
    }
}
