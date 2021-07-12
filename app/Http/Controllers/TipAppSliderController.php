<?php

namespace App\Http\Controllers;

use App\DataTables\TipAppSliderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTipAppSliderRequest;
use App\Http\Requests\UpdateTipAppSliderRequest;
use App\Repositories\TipAppSliderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class TipAppSliderController extends AppBaseController
{
    /** @var  TipAppSliderRepository */
    private $tipAppSliderRepository;

    public function __construct(TipAppSliderRepository $tipAppSliderRepo)
    {
        $this->tipAppSliderRepository = $tipAppSliderRepo;
    }

    /**
     * Display a listing of the TipAppSlider.
     *
     * @param TipAppSliderDataTable $tipAppSliderDataTable
     * @return Response
     */
    public function index(TipAppSliderDataTable $tipAppSliderDataTable)
    {
        return $tipAppSliderDataTable->render('tip_app_sliders.index');
    }

    /**
     * Show the form for creating a new TipAppSlider.
     *
     * @return Response
     */
    public function create()
    {
        return view('tip_app_sliders.create');
    }

    /**
     * Store a newly created TipAppSlider in storage.
     *
     * @param CreateTipAppSliderRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required',
            'description' => 'required',


        ]);
        // $photo = '';
        // if($request->hasFile('photo')){
        //     $photo = basename($request->photo->store('public/uploads/images/app-tip-sliders'));
        // }
        $input = $request->all();
        $file = $request->file('image');
        if($request->hasFile('image')){
            $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->image->move(public_path('/uploads/images/app-tip-sliders'), $filename);
               $input['image']=$filename;
        }
        else{
            \Session::flash('msg','e:يجب اختيار صورة السلايدر ');
            return redirect('/tipAppSliders/create')->withInput();

        }
        // $request['image'] = $photo;

        // $input = $request->all();

        $tipAppSlider = $this->tipAppSliderRepository->create($input);

        Flash::success('تم اضافة سلايدر جديد بنجاح');

        return redirect(route('tipAppSliders.index'));
    }

    /**
     * Display the specified TipAppSlider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipAppSlider = $this->tipAppSliderRepository->find($id);

        if (empty($tipAppSlider)) {
            Flash::error('السلايدر غير متوفر ');

            return redirect(route('tipAppSliders.index'));
        }

        return view('tip_app_sliders.show')->with('tipAppSlider', $tipAppSlider);
    }

    /**
     * Show the form for editing the specified TipAppSlider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipAppSlider = $this->tipAppSliderRepository->find($id);

        if (empty($tipAppSlider)) {
            Flash::error('السلايدر غير متوفر ');
           

            return redirect(route('tipAppSliders.index'));
        }

        return view('tip_app_sliders.edit')->with('tipAppSlider', $tipAppSlider);
    }

    /**
     * Update the specified TipAppSlider in storage.
     *
     * @param  int              $id
     * @param UpdateTipAppSliderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipAppSliderRequest $request)
    {
        $tipAppSlider = $this->tipAppSliderRepository->find($id);

        if (empty($tipAppSlider)) {
            Flash::error('السلايدر غير متوفر ');
            

            return redirect(route('tipAppSliders.index'));
        }

        // if($request->hasFile('photo')){
        //     $photo = basename($request->photo->store('public/uploads/images/app-tip-sliders'));
        //     $request['image'] = $photo;
        // }
        $oldimg = $tipAppSlider->image;
        $input = $request->all();
        $file = $request->file('image');
        if(!empty($file)){
               $filename = time() . '.' . $file->getClientOriginalExtension();
               request()->image->move(public_path('/uploads/images/app-tip-sliders'), $filename);
               $input['image']=$filename;
       }else{
               $input['image']=$oldimg;
       }

        $tipAppSlider = $this->tipAppSliderRepository->update($input, $id);

        Flash::success('تم تعديل السلايدر بنجاح');

        return redirect(route('tipAppSliders.index'));
    }

    
    /**
     * Remove the specified TipAppSlider from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipAppSlider = $this->tipAppSliderRepository->find($id);

        if (empty($tipAppSlider)) {
            Flash::error('السلايدر غير متوفر ');

            return redirect(route('tipAppSliders.index'));
        }

        $this->tipAppSliderRepository->delete($id);

        Flash::success('تم حذف السلايدر بنجاح');

        return redirect(route('tipAppSliders.index'));
    }
}
