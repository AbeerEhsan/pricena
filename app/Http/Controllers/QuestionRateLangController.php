<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionRateLangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionRateLangRequest;
use App\Http\Requests\UpdateQuestionRateLangRequest;
use App\Repositories\QuestionRateLangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class QuestionRateLangController extends AppBaseController
{
    /** @var  QuestionRateLangRepository */
    private $questionRateLangRepository;

    public function __construct(QuestionRateLangRepository $questionRateLangRepo)
    {
        $this->questionRateLangRepository = $questionRateLangRepo;
    }

    /**
     * Display a listing of the QuestionRateLang.
     *
     * @param QuestionRateLangDataTable $questionRateLangDataTable
     * @return Response
     */
    public function index(QuestionRateLangDataTable $questionRateLangDataTable)
    {
        return $questionRateLangDataTable->render('question_rate_langs.index');
    }

    /**
     * Show the form for creating a new QuestionRateLang.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_rate_langs.create');
    }

    /**
     * Store a newly created QuestionRateLang in storage.
     *
     * @param CreateQuestionRateLangRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRateLangRequest $request)
    {
        $input = $request->all();

        $questionRateLang = $this->questionRateLangRepository->create($input);

        Flash::success('Question Rate Lang saved successfully.');

        return redirect(route('questionRateLangs.index'));
    }

    /**
     * Display the specified QuestionRateLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionRateLang = $this->questionRateLangRepository->find($id);

        if (empty($questionRateLang)) {
            Flash::error('Question Rate Lang not found');

            return redirect(route('questionRateLangs.index'));
        }

        return view('question_rate_langs.show')->with('questionRateLang', $questionRateLang);
    }

    /**
     * Show the form for editing the specified QuestionRateLang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionRateLang = $this->questionRateLangRepository->find($id);

        if (empty($questionRateLang)) {
            Flash::error('Question Rate Lang not found');

            return redirect(route('questionRateLangs.index'));
        }

        return view('question_rate_langs.edit')->with('questionRateLang', $questionRateLang);
    }

    /**
     * Update the specified QuestionRateLang in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionRateLangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRateLangRequest $request)
    {
        $questionRateLang = $this->questionRateLangRepository->find($id);

        if (empty($questionRateLang)) {
            Flash::error('Question Rate Lang not found');

            return redirect(route('questionRateLangs.index'));
        }

        $questionRateLang = $this->questionRateLangRepository->update($request->all(), $id);

        Flash::success('Question Rate Lang updated successfully.');

        return redirect(route('questionRateLangs.index'));
    }

    /**
     * Remove the specified QuestionRateLang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionRateLang = $this->questionRateLangRepository->find($id);

        if (empty($questionRateLang)) {
            Flash::error('Question Rate Lang not found');

            return redirect(route('questionRateLangs.index'));
        }

        $this->questionRateLangRepository->delete($id);

        Flash::success('Question Rate Lang deleted successfully.');

        return redirect(route('questionRateLangs.index'));
    }
}
