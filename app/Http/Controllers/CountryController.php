<?php

namespace App\Http\Controllers;

use App\DataTables\CountryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Language;

class CountryController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     *
     * @param CountryDataTable $countryDataTable
     * @return Response
     */
    public function index(CountryDataTable $countryDataTable)
    {
        return $countryDataTable->render('countries.index');
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */
    public function create()
    {
        $languages = Language::all();
        return view('countries.create',compact('languages'));
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();

        $country = $this->countryRepository->create($input);

        Flash::success('تم حفظ معلومات البلد بنجاح . ');

        return redirect(route('countries.index'));
    }

    /**
     * Display the specified Country.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('البلد غير متوفرة . ');

            return redirect(route('countries.index'));
        }

        return view('countries.show')->with('country', $country);
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $country = $this->countryRepository->find($id);
        $languages = Language::all();

        if (empty($country)) {
            Flash::error('البلد غير متوفرة . ');

            return redirect(route('countries.index'));
        }

        return view('countries.edit')->with('country', $country)->with('languages', $language);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param  int              $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('البلد غير متوفرة . ');

            return redirect(route('countries.index'));
        }

        $country = $this->countryRepository->update($request->all(), $id);

        Flash::success('تم تعديل البلد بنجاح . ');

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('البلد غير متوفرة . ');

            return redirect(route('countries.index'));
        }

        $this->countryRepository->delete($id);

        Flash::success('تم حذف معلومات البلد بنجاح . ');

        return redirect(route('countries.index'));
    }
}
