<?php

namespace App\Http\Controllers;

use App\DataTables\CobonProductDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCobonProductRequest;
use App\Http\Requests\UpdateCobonProductRequest;
use App\Repositories\CobonProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CobonProductController extends AppBaseController
{
    /** @var  CobonProductRepository */
    private $cobonProductRepository;

    public function __construct(CobonProductRepository $cobonProductRepo)
    {
        $this->cobonProductRepository = $cobonProductRepo;
    }

    /**
     * Display a listing of the CobonProduct.
     *
     * @param CobonProductDataTable $cobonProductDataTable
     * @return Response
     */
    public function index(CobonProductDataTable $cobonProductDataTable)
    {
        return $cobonProductDataTable->render('cobon_products.index');
    }

    /**
     * Show the form for creating a new CobonProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('cobon_products.create');
    }

    /**
     * Store a newly created CobonProduct in storage.
     *
     * @param CreateCobonProductRequest $request
     *
     * @return Response
     */
    public function store(CreateCobonProductRequest $request)
    {
        $input = $request->all();

        $cobonProduct = $this->cobonProductRepository->create($input);

        Flash::success('Cobon Product saved successfully.');

        return redirect(route('cobonProducts.index'));
    }

    /**
     * Display the specified CobonProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cobonProduct = $this->cobonProductRepository->find($id);

        if (empty($cobonProduct)) {
            Flash::error('Cobon Product not found');

            return redirect(route('cobonProducts.index'));
        }

        return view('cobon_products.show')->with('cobonProduct', $cobonProduct);
    }

    /**
     * Show the form for editing the specified CobonProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cobonProduct = $this->cobonProductRepository->find($id);

        if (empty($cobonProduct)) {
            Flash::error('Cobon Product not found');

            return redirect(route('cobonProducts.index'));
        }

        return view('cobon_products.edit')->with('cobonProduct', $cobonProduct);
    }

    /**
     * Update the specified CobonProduct in storage.
     *
     * @param  int              $id
     * @param UpdateCobonProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCobonProductRequest $request)
    {
        $cobonProduct = $this->cobonProductRepository->find($id);

        if (empty($cobonProduct)) {
            Flash::error('Cobon Product not found');

            return redirect(route('cobonProducts.index'));
        }

        $cobonProduct = $this->cobonProductRepository->update($request->all(), $id);

        Flash::success('Cobon Product updated successfully.');

        return redirect(route('cobonProducts.index'));
    }

    /**
     * Remove the specified CobonProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cobonProduct = $this->cobonProductRepository->find($id);

        if (empty($cobonProduct)) {
            Flash::error('Cobon Product not found');

            return redirect(route('cobonProducts.index'));
        }

        $this->cobonProductRepository->delete($id);

        Flash::success('Cobon Product deleted successfully.');

        return redirect(route('cobonProducts.index'));
    }
}
