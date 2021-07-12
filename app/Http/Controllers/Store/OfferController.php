<?php

namespace App\Http\Controllers\Store;

use App\DataTables\OfferDataTable;
use App\DataTables\StoreOfferDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Repositories\OfferRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Store;
use Response;
use Auth;
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
     * @param StoreOfferDataTable $offerDataTable
     * @return Response
     */
    public function index(StoreOfferDataTable $offerDataTable)
    {

        return $offerDataTable->render('store_offers.index');
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
        return view('store_offers.create',compact('products','stores'));
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

        $offer = Offer::create([
            'store_id' => Store::where('user_id',Auth::user()->id)->first()->id ,
            'product_id'    => $request['product_id'],
            'link'    => $request['link'],
            'discount'    => $request['discount'],
         ]);
        

        Flash::success('Offer saved successfully.');

        return redirect(route('storeOffers.index'));
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
            Flash::error('Offer not found');

            return redirect(route('storeOffers.index'));
        }

        return view('store_offers.show',compact('products','stores','offer'));
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
            Flash::error('Offer not found');

            return redirect(route('storeOffers.index'));
        }

        return view('store_offers.edit',compact('products','stores','offer'));
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
            Flash::error('Offer not found');

            return redirect(route('storeOffers.index'));
        }

        $offer = $this->offerRepository->update($request->all(), $id);

        Flash::success('Offer updated successfully.');

        return redirect(route('storeOffers.index'));
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
            Flash::error('Offer not found');

            return redirect(route('storeOffers.index'));
        }

        $this->offerRepository->delete($id);

        Flash::success('Offer deleted successfully.');

        return redirect(route('storeOffers.index'));
    }
}
