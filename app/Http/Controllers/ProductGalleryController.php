<?php

namespace App\Http\Controllers;

use App\DataTables\ProductGalleryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductGalleryRequest;
use App\Http\Requests\UpdateProductGalleryRequest;
use App\Repositories\ProductGalleryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProductGalleryController extends AppBaseController
{
    /** @var  ProductGalleryRepository */
    private $productGalleryRepository;

    public function __construct(ProductGalleryRepository $productGalleryRepo)
    {
        $this->productGalleryRepository = $productGalleryRepo;
    }

    /**
     * Display a listing of the ProductGallery.
     *
     * @param ProductGalleryDataTable $productGalleryDataTable
     * @return Response
     */
    public function index(ProductGalleryDataTable $productGalleryDataTable)
    {
        return $productGalleryDataTable->render('product_galleries.index');
    }

    /**
     * Show the form for creating a new ProductGallery.
     *
     * @return Response
     */
    public function create()
    {
        return view('product_galleries.create');
    }

    /**
     * Store a newly created ProductGallery in storage.
     *
     * @param CreateProductGalleryRequest $request
     *
     * @return Response
     */
    public function store(CreateProductGalleryRequest $request)
    {
        $input = $request->all();

        $productGallery = $this->productGalleryRepository->create($input);

        Flash::success('Product Gallery saved successfully.');

        return redirect(route('productGalleries.index'));
    }

    /**
     * Display the specified ProductGallery.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productGallery = $this->productGalleryRepository->find($id);

        if (empty($productGallery)) {
            Flash::error('Product Gallery not found');

            return redirect(route('productGalleries.index'));
        }

        return view('product_galleries.show')->with('productGallery', $productGallery);
    }

    /**
     * Show the form for editing the specified ProductGallery.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productGallery = $this->productGalleryRepository->find($id);

        if (empty($productGallery)) {
            Flash::error('Product Gallery not found');

            return redirect(route('productGalleries.index'));
        }

        return view('product_galleries.edit')->with('productGallery', $productGallery);
    }

    /**
     * Update the specified ProductGallery in storage.
     *
     * @param  int              $id
     * @param UpdateProductGalleryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductGalleryRequest $request)
    {
        $productGallery = $this->productGalleryRepository->find($id);

        if (empty($productGallery)) {
            Flash::error('Product Gallery not found');

            return redirect(route('productGalleries.index'));
        }

        $productGallery = $this->productGalleryRepository->update($request->all(), $id);

        Flash::success('Product Gallery updated successfully.');

        return redirect(route('productGalleries.index'));
    }

    /**
     * Remove the specified ProductGallery from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productGallery = $this->productGalleryRepository->find($id);

        if (empty($productGallery)) {
            Flash::error('Product Gallery not found');

            return redirect(route('productGalleries.index'));
        }

        $this->productGalleryRepository->delete($id);

        Flash::success('Product Gallery deleted successfully.');

        return redirect(route('productGalleries.index'));
    }
}
