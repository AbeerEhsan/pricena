<?php

namespace App\Http\Controllers;

use App\DataTables\SliderLangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSliderLangRequest;
use App\Http\Requests\UpdateSliderLangRequest;
use App\Repositories\SliderLangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SliderLangController extends AppBaseController
{
    /** @var  SliderLangRepository */
    private $sliderLangRepository;

    public function __construct(SliderLangRepository $sliderLangRepo)
    {
        $this->sliderLangRepository = $sliderLangRepo;
    }

    /**
     * Display a listing of the SliderLang.
     *
     * @param SliderLangDataTable $sliderLangDataTable
     * @return Response
     */
    public function index(SliderLangDataTable $sliderLangDataTable)
    {
        return $sliderLangDataTable->render('slider_langs.index');
    }

    /**
     * Show the form for creating a new SliderLang.
     *
     * @return Response
     */
    public function create()
    {
        return view('slider_langs.create');
    }

    /**
     * Store a newly created SliderLang in storage.
     *
     * @param CreateSliderLangRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderLangRequest $request)
    {
        $input = $request->all();

        $sliderLang = $this->sliderLangRepository->create($input);

        Flash::success('Slider Lang saved successfully.');

        return redirect(route('sliderLangs.index'));
    }

    /**
     * Display the specified SliderLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sliderLang = $this->sliderLangRepository->find($id);

        if (empty($sliderLang)) {
            Flash::error('Slider Lang not found');

            return redirect(route('sliderLangs.index'));
        }

        return view('slider_langs.show')->with('sliderLang', $sliderLang);
    }

    /**
     * Show the form for editing the specified SliderLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sliderLang = $this->sliderLangRepository->find($id);

        if (empty($sliderLang)) {
            Flash::error('Slider Lang not found');

            return redirect(route('sliderLangs.index'));
        }

        return view('slider_langs.edit')->with('sliderLang', $sliderLang);
    }

    /**
     * Update the specified SliderLang in storage.
     *
     * @param  int              $id
     * @param UpdateSliderLangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderLangRequest $request)
    {
        $sliderLang = $this->sliderLangRepository->find($id);

        if (empty($sliderLang)) {
            Flash::error('Slider Lang not found');

            return redirect(route('sliderLangs.index'));
        }

        $sliderLang = $this->sliderLangRepository->update($request->all(), $id);

        Flash::success('Slider Lang updated successfully.');

        return redirect(route('sliderLangs.index'));
    }

    /**
     * Remove the specified SliderLang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sliderLang = $this->sliderLangRepository->find($id);

        if (empty($sliderLang)) {
            Flash::error('Slider Lang not found');

            return redirect(route('sliderLangs.index'));
        }

        $this->sliderLangRepository->delete($id);

        Flash::success('Slider Lang deleted successfully.');

        return redirect(route('sliderLangs.index'));
    }
}
