<?php

namespace App\Http\Controllers;

use App\DataTables\LanguageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Repositories\LanguageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Language;
use Response;

class LanguageController extends AppBaseController
{
    /** @var  LanguageRepository */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->languageRepository = $languageRepo;
    }

    /**
     * Display a listing of the Language.
     *
     * @param LanguageDataTable $languageDataTable
     * @return Response
     */
    public function index(LanguageDataTable $languageDataTable)
    {
        return $languageDataTable->render('languages.index');
    }

    /**
     * Show the form for creating a new Language.
     *
     * @return Response
     */
    public function create()
    {
        return view('languages.create');
    }

    /**
     * Store a newly created Language in storage.
     *
     * @param CreateLanguageRequest $request
     *
     * @return Response
     */
    public function store(CreateLanguageRequest $request)
    {
        $input = $request->all();

        $language = $this->languageRepository->create($input);

        Flash::success('تم حفظ معلومات اللغة بنجاح . ');

        return redirect(route('languages.index'));
    }

    /**
     * Display the specified Language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('اللغة غير متوفرة . ');

            return redirect(route('languages.index'));
        }

        return view('languages.show')->with('language', $language);
    }

    /**
     * Show the form for editing the specified Language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('اللغة غير متوفرة . ');

            return redirect(route('languages.index'));
        }

        return view('languages.edit')->with('language', $language);
    }

    /**
     * Update the specified Language in storage.
     *
     * @param  int              $id
     * @param UpdateLanguageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLanguageRequest $request)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('اللغة غير متوفرة . ');

            return redirect(route('languages.index'));
        }

        $language = $this->languageRepository->update($request->all(), $id);

        Flash::success('تم تحديث معلومات اللغة بنجاح . ');

        return redirect(route('languages.index'));
    }

    /**
     * Remove the specified Language from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('اللغة غير متوفرة . ');

            return redirect(route('languages.index'));
        }

        $this->languageRepository->delete($id);

        Flash::success('تم حذف معلومات اللغة بنجاح . ');

        return redirect(route('languages.index'));
    }
}
