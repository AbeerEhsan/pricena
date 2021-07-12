<?php

namespace App\Http\Controllers;

use App\DataTables\StoreLangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStoreLangRequest;
use App\Http\Requests\UpdateStoreLangRequest;
use App\Repositories\StoreLangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class StoreLangController extends AppBaseController
{
    /** @var  StoreLangRepository */
    private $storeLangRepository;

    public function __construct(StoreLangRepository $storeLangRepo)
    {
        $this->storeLangRepository = $storeLangRepo;
    }

    /**
     * Display a listing of the StoreLang.
     *
     * @param StoreLangDataTable $storeLangDataTable
     * @return Response
     */
    public function index(StoreLangDataTable $storeLangDataTable)
    {
        return $storeLangDataTable->render('store_langs.index');
    }

    /**
     * Show the form for creating a new StoreLang.
     *
     * @return Response
     */
    public function create()
    {
        return view('store_langs.create');
    }

    /**
     * Store a newly created StoreLang in storage.
     *
     * @param CreateStoreLangRequest $request
     *
     * @return Response
     */
    public function store(CreateStoreLangRequest $request)
    {
        $input = $request->all();

        $storeLang = $this->storeLangRepository->create($input);

        Flash::success('Store Lang saved successfully.');

        return redirect(route('storeLangs.index'));
    }

    /**
     * Display the specified StoreLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $storeLang = $this->storeLangRepository->find($id);

        if (empty($storeLang)) {
            Flash::error('Store Lang not found');

            return redirect(route('storeLangs.index'));
        }

        return view('store_langs.show')->with('storeLang', $storeLang);
    }

    /**
     * Show the form for editing the specified StoreLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $storeLang = $this->storeLangRepository->find($id);

        if (empty($storeLang)) {
            Flash::error('Store Lang not found');

            return redirect(route('storeLangs.index'));
        }

        return view('store_langs.edit')->with('storeLang', $storeLang);
    }

    /**
     * Update the specified StoreLang in storage.
     *
     * @param  int              $id
     * @param UpdateStoreLangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStoreLangRequest $request)
    {
        $storeLang = $this->storeLangRepository->find($id);

        if (empty($storeLang)) {
            Flash::error('Store Lang not found');

            return redirect(route('storeLangs.index'));
        }

        $storeLang = $this->storeLangRepository->update($request->all(), $id);

        Flash::success('Store Lang updated successfully.');

        return redirect(route('storeLangs.index'));
    }

    /**
     * Remove the specified StoreLang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $storeLang = $this->storeLangRepository->find($id);

        if (empty($storeLang)) {
            Flash::error('Store Lang not found');

            return redirect(route('storeLangs.index'));
        }

        $this->storeLangRepository->delete($id);

        Flash::success('Store Lang deleted successfully.');

        return redirect(route('storeLangs.index'));
    }
}
