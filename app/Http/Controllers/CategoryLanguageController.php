<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryLanguageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCategoryLanguageRequest;
use App\Http\Requests\UpdateCategoryLanguageRequest;
use App\Repositories\CategoryLanguageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CategoryLanguageController extends AppBaseController
{
    /** @var  CategoryLanguageRepository */
    private $categoryLanguageRepository;

    public function __construct(CategoryLanguageRepository $categoryLanguageRepo)
    {
        $this->categoryLanguageRepository = $categoryLanguageRepo;
    }

    /**
     * Display a listing of the CategoryLanguage.
     *
     * @param CategoryLanguageDataTable $categoryLanguageDataTable
     * @return Response
     */
    public function index(CategoryLanguageDataTable $categoryLanguageDataTable)
    {
        return $categoryLanguageDataTable->render('category_languages.index');
    }

    /**
     * Show the form for creating a new CategoryLanguage.
     *
     * @return Response
     */
    public function create()
    {
        return view('category_languages.create');
    }

    /**
     * Store a newly created CategoryLanguage in storage.
     *
     * @param CreateCategoryLanguageRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryLanguageRequest $request)
    {
        $input = $request->all();

        $categoryLanguage = $this->categoryLanguageRepository->create($input);

        Flash::success('Category Language saved successfully.');

        return redirect(route('categoryLanguages.index'));
    }

    /**
     * Display the specified CategoryLanguage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryLanguage = $this->categoryLanguageRepository->find($id);

        if (empty($categoryLanguage)) {
            Flash::error('Category Language not found');

            return redirect(route('categoryLanguages.index'));
        }

        return view('category_languages.show')->with('categoryLanguage', $categoryLanguage);
    }

    /**
     * Show the form for editing the specified CategoryLanguage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryLanguage = $this->categoryLanguageRepository->find($id);

        if (empty($categoryLanguage)) {
            Flash::error('Category Language not found');

            return redirect(route('categoryLanguages.index'));
        }

        return view('category_languages.edit')->with('categoryLanguage', $categoryLanguage);
    }

    /**
     * Update the specified CategoryLanguage in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryLanguageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryLanguageRequest $request)
    {
        $categoryLanguage = $this->categoryLanguageRepository->find($id);

        if (empty($categoryLanguage)) {
            Flash::error('Category Language not found');

            return redirect(route('categoryLanguages.index'));
        }

        $categoryLanguage = $this->categoryLanguageRepository->update($request->all(), $id);

        Flash::success('Category Language updated successfully.');

        return redirect(route('categoryLanguages.index'));
    }

    /**
     * Remove the specified CategoryLanguage from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoryLanguage = $this->categoryLanguageRepository->find($id);

        if (empty($categoryLanguage)) {
            Flash::error('Category Language not found');

            return redirect(route('categoryLanguages.index'));
        }

        $this->categoryLanguageRepository->delete($id);

        Flash::success('Category Language deleted successfully.');

        return redirect(route('categoryLanguages.index'));
    }
}
