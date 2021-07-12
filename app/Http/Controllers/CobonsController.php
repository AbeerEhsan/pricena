<?php

namespace App\Http\Controllers;

use App\DataTables\CobonsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCobonsRequest;
use App\Http\Requests\UpdateCobonsRequest;
use App\Repositories\CobonsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Cobon;

class CobonsController extends AppBaseController
{
    /** @var  CobonsRepository */
    private $cobonsRepository;

    public function __construct(CobonsRepository $cobonsRepo)
    {
        $this->cobonsRepository = $cobonsRepo;
    }

    /**
     * Display a listing of the Cobons.
     *
     * @param CobonsDataTable $cobonsDataTable
     * @return Response
     */
    public function index(CobonsDataTable $cobonsDataTable)
    {
        return $cobonsDataTable->render('cobons.index');
    }

    /**
     * Show the form for creating a new Cobons.
     *
     * @return Response
     */
    public function create()
    {
        return view('cobons.create');
    }

    /**
     * Store a newly created Cobons in storage.
     *
     * @param CreateCobonsRequest $request
     *
     * @return Response
     */
    public function store(CreateCobonsRequest $request)
    {
        $input = $request->all();

        $cobons = $this->cobonsRepository->create($input);

        Flash::success('Cobons saved successfully.');

        return redirect(route('cobons.index'));
    }

    /**
     * Display the specified Cobons.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cobons = $this->cobonsRepository->find($id);

        if (empty($cobons)) {
            Flash::error('Cobons not found');

            return redirect(route('cobons.index'));
        }

        return view('cobons.show')->with('cobons', $cobons);
    }

    /**
     * Show the form for editing the specified Cobons.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cobons = $this->cobonsRepository->find($id);

        if (empty($cobons)) {
            Flash::error('Cobons not found');

            return redirect(route('cobons.index'));
        }

        return view('cobons.edit')->with('cobons', $cobons);
    }

    /**
     * Update the specified Cobons in storage.
     *
     * @param  int              $id
     * @param UpdateCobonsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCobonsRequest $request)
    {
        $cobons = $this->cobonsRepository->find($id);

        if (empty($cobons)) {
            Flash::error('Cobons not found');

            return redirect(route('cobons.index'));
        }

        $cobons = $this->cobonsRepository->update($request->all(), $id);

        Flash::success('Cobons updated successfully.');

        return redirect(route('cobons.index'));
    }

    /**
     * Remove the specified Cobons from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cobons = $this->cobonsRepository->find($id);

        if (empty($cobons)) {
            Flash::error('Cobons not found');

            return redirect(route('cobons.index'));
        }

        $this->cobonsRepository->delete($id);

        Flash::success('Cobons deleted successfully.');

        return redirect(route('cobons.index'));
    }
}
