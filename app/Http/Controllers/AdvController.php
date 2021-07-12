<?php

namespace App\Http\Controllers;

use App\DataTables\AdvDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAdvRequest;
use App\Http\Requests\UpdateAdvRequest;
use App\Repositories\AdvRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class AdvController extends AppBaseController
{
    /** @var  AdvRepository */
    private $advRepository;

    public function __construct(AdvRepository $advRepo)
    {
        $this->advRepository = $advRepo;
    }

    /**
     * Display a listing of the Adv.
     *
     * @param AdvDataTable $advDataTable
     * @return Response
     */
    public function index(AdvDataTable $advDataTable)
    {
        return $advDataTable->render('advs.index');
    }

    /**
     * Show the form for creating a new Adv.
     *
     * @return Response
     */
    public function create()
    {
        return view('advs.create');
    }

    /**
     * Store a newly created Adv in storage.
     *
     * @param CreateAdvRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required',
            'link' => 'required',
            'description' => 'required',
            'type' => 'required',


        ]);

        $input = $request->all();
        $file = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            request()->img->move(public_path('/uploads/images/adv'), $filename);
            $input['media_link'] = $filename;
        } else {
            \Session::flash('msg', 'e:يجب اختيار صورة الاعلان ');
            return redirect('/advs/create')->withInput();
        }

        $adv = $this->advRepository->create($input);

        Flash::success('تم اضافة اعلان جديد بنجاح.');

        return redirect(route('advs.index'));
    }

    /**
     * Display the specified Adv.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $adv = $this->advRepository->find($id);

        if (empty($adv)) {
            Flash::error('الاعلان غير متوفر');

            return redirect(route('advs.index'));
        }

        return view('advs.show')->with('adv', $adv);
    }

    /**
     * Show the form for editing the specified Adv.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $adv = $this->advRepository->find($id);

        if (empty($adv)) {
            Flash::error('الاعلان غير متوفر');

            return redirect(route('advs.index'));
        }

        return view('advs.edit')->with('adv', $adv);
    }

    /**
     * Update the specified Adv in storage.
     *
     * @param  int              $id
     * @param UpdateAdvRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdvRequest $request)
    {
        $adv = $this->advRepository->find($id);

        if (empty($adv)) {
            Flash::error('الاعلان غير متوفر');

            return redirect(route('advs.index'));
        }

        $oldimg = $adv->media_link;
        $input = $request->all();
        $file = $request->file('img');
        if (!empty($file)) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            request()->img->move(public_path('/uploads/images/adv'), $filename);
            $input['media_link'] = $filename;
        } else {
            $input['media_link'] = $oldimg;
        }

        $adv = $this->advRepository->update( $input, $id);

        Flash::success('تم تعديل الاعلان بنجاح');

        return redirect(route('advs.index'));
    }

    /**
     * Remove the specified Adv from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $adv = $this->advRepository->find($id);

        if (empty($adv)) {
            Flash::error('الاعلان غير متوفر');

            return redirect(route('advs.index'));
        }

        $this->advRepository->delete($id);

        Flash::success('Adv deleted successfully.');

        return redirect(route('advs.index'));
    }
}
