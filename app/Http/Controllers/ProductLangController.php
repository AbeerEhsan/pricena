<?php

namespace App\Http\Controllers;

use App\DataTables\ProductLangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductLangRequest;
use App\Http\Requests\UpdateProductLangRequest;
use App\Repositories\ProductLangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProductLangController extends AppBaseController
{
    /** @var  ProductLangRepository */
    private $productLangRepository;

    public function __construct(ProductLangRepository $productLangRepo)
    {
        $this->productLangRepository = $productLangRepo;
    }

    /**
     * Display a listing of the ProductLang.
     *
     * @param ProductLangDataTable $productLangDataTable
     * @return Response
     */
    public function index(ProductLangDataTable $productLangDataTable)
    {
        return $productLangDataTable->render('product_langs.index');
    }

    /**
     * Show the form for creating a new ProductLang.
     *
     * @return Response
     */
    public function create()
    {
        return view('product_langs.create');
    }

    /**
     * Store a newly created ProductLang in storage.
     *
     * @param CreateProductLangRequest $request
     *
     * @return Response
     */
    public function store(CreateProductLangRequest $request)
    {
        $input = $request->all();

        $productLang = $this->productLangRepository->create($input);

        Flash::success('Product Lang saved successfully.');

        return redirect(route('productLangs.index'));
    }

    /**
     * Display the specified ProductLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productLang = $this->productLangRepository->find($id);

        if (empty($productLang)) {
            Flash::error('Product Lang not found');

            return redirect(route('productLangs.index'));
        }

        return view('product_langs.show')->with('productLang', $productLang);
    }

    /**
     * Show the form for editing the specified ProductLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productLang = $this->productLangRepository->find($id);

        if (empty($productLang)) {
            Flash::error('Product Lang not found');

            return redirect(route('productLangs.index'));
        }

        return view('product_langs.edit')->with('productLang', $productLang);
    }

    /**
     * Update the specified ProductLang in storage.
     *
     * @param  int              $id
     * @param UpdateProductLangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductLangRequest $request)
    {
        $productLang = $this->productLangRepository->find($id);

        if (empty($productLang)) {
            Flash::error('Product Lang not found');

            return redirect(route('productLangs.index'));
        }

        $productLang = $this->productLangRepository->update($request->all(), $id);

        Flash::success('Product Lang updated successfully.');

        return redirect(route('productLangs.index'));
    }

    /**
     * Remove the specified ProductLang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productLang = $this->productLangRepository->find($id);

        if (empty($productLang)) {
            Flash::error('Product Lang not found');

            return redirect(route('productLangs.index'));
        }

        $this->productLangRepository->delete($id);

        Flash::success('Product Lang deleted successfully.');

        return redirect(route('productLangs.index'));
    }
}
