<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionRatesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionRatesRequest;
use App\Http\Requests\UpdateQuestionRatesRequest;
use App\Repositories\QuestionRatesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class QuestionRatesController extends AppBaseController
{
    /** @var  QuestionRatesRepository */
    private $questionRatesRepository;

    public function __construct(QuestionRatesRepository $questionRatesRepo)
    {
        $this->questionRatesRepository = $questionRatesRepo;
    }

    /**
     * Display a listing of the QuestionRates.
     *
     * @param QuestionRatesDataTable $questionRatesDataTable
     * @return Response
     */
    public function index(QuestionRatesDataTable $questionRatesDataTable)
    {
        return $questionRatesDataTable->render('question_rates.index');
    }

    /**
     * Show the form for creating a new QuestionRates.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_rates.create');
    }

    /**
     * Store a newly created QuestionRates in storage.
     *
     * @param CreateQuestionRatesRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRatesRequest $request)
    {
        $input = $request->all();

        $questionRates = $this->questionRatesRepository->create($input);

        Flash::success('Question Rates saved successfully.');

        return redirect(route('questionRates.index'));
    }

    /**
     * Display the specified QuestionRates.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionRates = $this->questionRatesRepository->find($id);

        if (empty($questionRates)) {
            Flash::error('Question Rates not found');

            return redirect(route('questionRates.index'));
        }

        return view('question_rates.show')->with('questionRates', $questionRates);
    }

    /**
     * Show the form for editing the specified QuestionRates.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionRates = $this->questionRatesRepository->find($id);

        if (empty($questionRates)) {
            Flash::error('Question Rates not found');

            return redirect(route('questionRates.index'));
        }

        return view('question_rates.edit')->with('questionRates', $questionRates);
    }

    /**
     * Update the specified QuestionRates in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionRatesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRatesRequest $request)
    {
        $questionRates = $this->questionRatesRepository->find($id);

        if (empty($questionRates)) {
            Flash::error('Question Rates not found');

            return redirect(route('questionRates.index'));
        }

        $questionRates = $this->questionRatesRepository->update($request->all(), $id);

        Flash::success('Question Rates updated successfully.');

        return redirect(route('questionRates.index'));
    }

    /**
     * Remove the specified QuestionRates from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionRates = $this->questionRatesRepository->find($id);

        if (empty($questionRates)) {
            Flash::error('Question Rates not found');

            return redirect(route('questionRates.index'));
        }

        $this->questionRatesRepository->delete($id);

        Flash::success('Question Rates deleted successfully.');

        return redirect(route('questionRates.index'));
    }
}
