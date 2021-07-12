<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionRateAnswerLangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionRateAnswerLangRequest;
use App\Http\Requests\UpdateQuestionRateAnswerLangRequest;
use App\Repositories\QuestionRateAnswerLangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class QuestionRateAnswerLangController extends AppBaseController
{
    /** @var  QuestionRateAnswerLangRepository */
    private $questionRateAnswerLangRepository;

    public function __construct(QuestionRateAnswerLangRepository $questionRateAnswerLangRepo)
    {
        $this->questionRateAnswerLangRepository = $questionRateAnswerLangRepo;
    }

    /**
     * Display a listing of the QuestionRateAnswerLang.
     *
     * @param QuestionRateAnswerLangDataTable $questionRateAnswerLangDataTable
     * @return Response
     */
    public function index(QuestionRateAnswerLangDataTable $questionRateAnswerLangDataTable)
    {
        return $questionRateAnswerLangDataTable->render('question_rate_answer_langs.index');
    }

    /**
     * Show the form for creating a new QuestionRateAnswerLang.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_rate_answer_langs.create');
    }

    /**
     * Store a newly created QuestionRateAnswerLang in storage.
     *
     * @param CreateQuestionRateAnswerLangRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRateAnswerLangRequest $request)
    {
        $input = $request->all();

        $questionRateAnswerLang = $this->questionRateAnswerLangRepository->create($input);

        Flash::success('Question Rate Answer Lang saved successfully.');

        return redirect(route('questionRateAnswerLangs.index'));
    }

    /**
     * Display the specified QuestionRateAnswerLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionRateAnswerLang = $this->questionRateAnswerLangRepository->find($id);

        if (empty($questionRateAnswerLang)) {
            Flash::error('Question Rate Answer Lang not found');

            return redirect(route('questionRateAnswerLangs.index'));
        }

        return view('question_rate_answer_langs.show')->with('questionRateAnswerLang', $questionRateAnswerLang);
    }

    /**
     * Show the form for editing the specified QuestionRateAnswerLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionRateAnswerLang = $this->questionRateAnswerLangRepository->find($id);

        if (empty($questionRateAnswerLang)) {
            Flash::error('Question Rate Answer Lang not found');

            return redirect(route('questionRateAnswerLangs.index'));
        }

        return view('question_rate_answer_langs.edit')->with('questionRateAnswerLang', $questionRateAnswerLang);
    }

    /**
     * Update the specified QuestionRateAnswerLang in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionRateAnswerLangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRateAnswerLangRequest $request)
    {
        $questionRateAnswerLang = $this->questionRateAnswerLangRepository->find($id);

        if (empty($questionRateAnswerLang)) {
            Flash::error('Question Rate Answer Lang not found');

            return redirect(route('questionRateAnswerLangs.index'));
        }

        $questionRateAnswerLang = $this->questionRateAnswerLangRepository->update($request->all(), $id);

        Flash::success('Question Rate Answer Lang updated successfully.');

        return redirect(route('questionRateAnswerLangs.index'));
    }

    /**
     * Remove the specified QuestionRateAnswerLang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionRateAnswerLang = $this->questionRateAnswerLangRepository->find($id);

        if (empty($questionRateAnswerLang)) {
            Flash::error('Question Rate Answer Lang not found');

            return redirect(route('questionRateAnswerLangs.index'));
        }

        $this->questionRateAnswerLangRepository->delete($id);

        Flash::success('Question Rate Answer Lang deleted successfully.');

        return redirect(route('questionRateAnswerLangs.index'));
    }
}
