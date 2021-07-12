<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionRateAnswerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionRateAnswerRequest;
use App\Http\Requests\UpdateQuestionRateAnswerRequest;
use App\Repositories\QuestionRateAnswerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class QuestionRateAnswerController extends AppBaseController
{
    /** @var  QuestionRateAnswerRepository */
    private $questionRateAnswerRepository;

    public function __construct(QuestionRateAnswerRepository $questionRateAnswerRepo)
    {
        $this->questionRateAnswerRepository = $questionRateAnswerRepo;
    }

    /**
     * Display a listing of the QuestionRateAnswer.
     *
     * @param QuestionRateAnswerDataTable $questionRateAnswerDataTable
     * @return Response
     */
    public function index(QuestionRateAnswerDataTable $questionRateAnswerDataTable)
    {
        return $questionRateAnswerDataTable->render('question_rate_answers.index');
    }

    /**
     * Show the form for creating a new QuestionRateAnswer.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_rate_answers.create');
    }

    /**
     * Store a newly created QuestionRateAnswer in storage.
     *
     * @param CreateQuestionRateAnswerRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRateAnswerRequest $request)
    {
        $input = $request->all();

        $questionRateAnswer = $this->questionRateAnswerRepository->create($input);

        Flash::success('Question Rate Answer saved successfully.');

        return redirect(route('questionRateAnswers.index'));
    }

    /**
     * Display the specified QuestionRateAnswer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionRateAnswer = $this->questionRateAnswerRepository->find($id);

        if (empty($questionRateAnswer)) {
            Flash::error('Question Rate Answer not found');

            return redirect(route('questionRateAnswers.index'));
        }

        return view('question_rate_answers.show')->with('questionRateAnswer', $questionRateAnswer);
    }

    /**
     * Show the form for editing the specified QuestionRateAnswer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionRateAnswer = $this->questionRateAnswerRepository->find($id);

        if (empty($questionRateAnswer)) {
            Flash::error('Question Rate Answer not found');

            return redirect(route('questionRateAnswers.index'));
        }

        return view('question_rate_answers.edit')->with('questionRateAnswer', $questionRateAnswer);
    }

    /**
     * Update the specified QuestionRateAnswer in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionRateAnswerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRateAnswerRequest $request)
    {
        $questionRateAnswer = $this->questionRateAnswerRepository->find($id);

        if (empty($questionRateAnswer)) {
            Flash::error('Question Rate Answer not found');

            return redirect(route('questionRateAnswers.index'));
        }

        $questionRateAnswer = $this->questionRateAnswerRepository->update($request->all(), $id);

        Flash::success('Question Rate Answer updated successfully.');

        return redirect(route('questionRateAnswers.index'));
    }

    /**
     * Remove the specified QuestionRateAnswer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionRateAnswer = $this->questionRateAnswerRepository->find($id);

        if (empty($questionRateAnswer)) {
            Flash::error('Question Rate Answer not found');

            return redirect(route('questionRateAnswers.index'));
        }

        $this->questionRateAnswerRepository->delete($id);

        Flash::success('Question Rate Answer deleted successfully.');

        return redirect(route('questionRateAnswers.index'));
    }
}
