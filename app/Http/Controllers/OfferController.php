<?php

namespace App\Http\Controllers;

use App\DataTables\OfferDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Repositories\OfferRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Product;
use App\Models\Store;
use Response;

class OfferController extends AppBaseController
{
    /** @var  OfferRepository */
    private $offerRepository;

    public function __construct(OfferRepository $offerRepo)
    {
        $this->offerRepository = $offerRepo;
    }

    /**
     * Display a listing of the Offer.
     *
     * @param OfferDataTable $offerDataTable
     * @return Response
     */
    public function index(OfferDataTable $offerDataTable)
    {
        return $offerDataTable->render('offers.index');
    }

    /**
     * Show the form for creating a new Offer.
     *
     * @return Response
     */
    public function create()
    {
        $products=Product::all();
        $stores=Store::all();
        return view('offers.create',compact('products','stores'));
    }

    /**
     * Store a newly created Offer in storage.
     *
     * @param CreateOfferRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferRequest $request)
    {
        $input = $request->all();

        $offer = $this->offerRepository->create($input);

        Flash::success('تم اضافة العرض بنجاح');

        return redirect(route('offers.index'));
    }

    /**
     * Display the specified Offer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $products=Product::all();
        $stores=Store::all();
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error('العرض غير متوفر');

            return redirect(route('offers.index'));
        }

        return view('offers.show',compact('products','stores','offer'));
    }

    /**
     * Show the form for editing the specified Offer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $products=Product::all();
        $stores=Store::all();
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error('العرض غير متوفر');

            return redirect(route('offers.index'));
        }

        return view('offers.edit',compact('products','stores','offer'));
    }

    

    /**
     * Update the specified Offer in storage.
     *
     * @param  int              $id
     * @param UpdateOfferRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferRequest $request)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error('العرض غير متوفر');

            return redirect(route('offers.index'));
        }

        $offer = $this->offerRepository->update($request->all(), $id);

        Flash::success('تم التعديل على العرض بنجاح');

        return redirect(route('offers.index'));
    }

    /**
     * Remove the specified Offer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error('العرض غير متوفر');

            return redirect(route('offers.index'));
        }

        $this->offerRepository->delete($id);

        Flash::success('تم حذف العرض بنجاح');

        return redirect(route('offers.index'));
    }
}
