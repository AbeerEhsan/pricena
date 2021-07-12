<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionRateDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionRateRequest;
use App\Http\Requests\UpdateQuestionRateRequest;
use App\Repositories\QuestionRateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\QuestionRateAnswer;
use App\Models\QuestionRateAnswerLang;
use App\Models\QuestionRateLang;
use Illuminate\Http\Request;
use Response;

class QuestionRateController extends AppBaseController
{
    /** @var  QuestionRateRepository */
    private $questionRateRepository;

    public function __construct(QuestionRateRepository $questionRateRepo)
    {
        $this->questionRateRepository = $questionRateRepo;
    }

    /**
     * Display a listing of the QuestionRate.
     *
     * @param QuestionRateDataTable $questionRateDataTable
     * @return Response
     */
    public function index(QuestionRateDataTable $questionRateDataTable)
    {
        return $questionRateDataTable->render('question_rates.index');
    }

    /**
     * Show the form for creating a new QuestionRate.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_rates.create');
    }

    /**
     * Store a newly created QuestionRate in storage.
     *
     * @param CreateQuestionRateRequest $request
     *
     * @return Response
     */
    public function store(Request $request){

        $request->validate([
            'question_ar' => 'required',
            'question_en' => 'required',
            'answer_ar' => 'required',
            'answer_en' => 'required',

        ]);

        $input = $request->all();
        $questionRate = $this->questionRateRepository->create($input);
        
        $questionRate_lan1 = QuestionRateLang::create([
            'question_id' =>$questionRate->id ,
            'lang_id' => '1',
            'question'    => $request['question_en'],
         ]);
 
 
     
        $questionRate_lan2 = QuestionRateLang::create([
             'question_id' => $questionRate->id,
             'lang_id' => '2',
             'question'    => $request['question_ar'],
          ]);


       
        $answersCount = count($request['answer_ar']);
        if ($answersCount >0) {
            $answersAr = $request['answer_ar'];
            $answersEn = $request['answer_en'];
                for ($i=0; $i < $answersCount; $i++) { 
                    $qus_answer = QuestionRateAnswer::create([
                        'question_id' => $questionRate->id,
                    ]);
                    
                    $ans_ar = QuestionRateAnswerLang::create([
                        'answer_id' => $qus_answer->id,
                        'lang_id' => '2',
                        'answer'    => $answersAr[$i]
                    ]);
                    $ans_en = QuestionRateAnswerLang::create([
                        'answer_id' => $qus_answer->id,
                        'lang_id' => '1',
                        'answer'    => $answersEn[$i]
                    ]);
                }

            }

        Flash::success('تم اضافة سؤال جديد بنجاح');

        return redirect(route('questionRates.index'));
    }

    /**
     * Display the specified QuestionRate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionRate = $this->questionRateRepository->find($id);
        
        if (empty($questionRate)) {
            Flash::error('السؤال غير متوفر');

            return redirect(route('questionRates.index'));
        }

        $questionAr=$questionRate->qusetionRateLangs->where('lang_id','=','2')->first()->question;
        $questionEn=$questionRate->qusetionRateLangs->where('lang_id','=','1')->first()->question;
       
     
        
        return view('question_rates.show',compact('questionRate', 'questionAr', 'questionEn', 'answerAr', 'answerEn'));
    }

    /**
     * Show the form for editing the specified QuestionRate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionRate = $this->questionRateRepository->find($id);
        if (empty($questionRate)) {
            Flash::error('السؤال غير متوفر');

            return redirect(route('questionRates.index'));
        }
        $questionAr=$questionRate->qusetionRateLangs->where('lang_id','=','2')->first()->question;
        $questionEn=$questionRate->qusetionRateLangs->where('lang_id','=','1')->first()->question;
       
        // $answerAr=$questionRate->qusetionRateAnswers->first()->qusetionRateAnswerLangs
        // ->where('lang_id','=','2')->first()->answer;

        // $answerEn=$questionRate->qusetionRateAnswers->first()->qusetionRateAnswerLangs
        // ->where('lang_id','=','1')->first()->answer;

       
      

        return view('question_rates.edit',compact('questionRate','questionAr','questionEn','answerAr','answerEn'));
    }

    /**
     * Update the specified QuestionRate in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionRateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRateRequest $request)
    {
        // dd($request);
        $questionRate = $this->questionRateRepository->find($id);

        if (empty($questionRate)) {
            Flash::error('السؤال غير متوفر');

            return redirect(route('questionRates.index'));
        }

        if($request->has('question_en')){
            $question_lan1=QuestionRateLang::where('question_id','=',$questionRate->id)->where('lang_id','=','1')->first();
            $question_lan1->update([
                'question_id' =>$questionRate->id ,
                'lang_id' => '1',
                'question'    => $request['question_en'],
             ]);
           
            }

            if($request->has('question_ar')){
            $question_lan2=QuestionRateLang::where('question_id','=',$questionRate->id)->where('lang_id','=','2')->first();
            $question_lan2->update([
                'question_id' =>$questionRate->id ,
                'lang_id' => '2',
                'question'    => $request['question_ar'],
                ]);
                }


        ////////////////////////////delete old answers/////////////////////////////////////////////////////
         
       foreach ($questionRate->qusetionRateAnswers as $old_answers) {
            $old_answers->delete();
       }

        ////////////////////////////store new answers////////////////////////////////////////////////////////////
//    dd($request['answer_ar'] );
        $answersCount = count($request['answer_ar']);
        if ($answersCount > 0) {
            $answersAr = $request['answer_ar'];
            $answersEn = $request['answer_en'];
            for ($i = 0; $i < $answersCount; $i++) {
                $qus_answer = QuestionRateAnswer::create([
                    'question_id' => $questionRate->id,
                ]);

                $ans_ar = QuestionRateAnswerLang::create([
                    'answer_id' => $qus_answer->id,
                    'lang_id' => '2',
                    'answer'    => $answersAr[$i]
                ]);
                $ans_en = QuestionRateAnswerLang::create([
                    'answer_id' => $qus_answer->id,
                    'lang_id' => '1',
                    'answer'    => $answersEn[$i]
                ]);
            }
        }
    
        ///////////////////////////////////////////////////////////////////////////////////


        $questionRate = $this->questionRateRepository->update($request->all(), $id);

        Flash::success('تم تعديل السؤال بنجاح');

        return redirect(route('questionRates.index'));
    }

    /**
     * Remove the specified QuestionRate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionRate = $this->questionRateRepository->find($id);

        if (empty($questionRate)) {
            Flash::error('السؤال غير متوفر');

            return redirect(route('questionRates.index'));
        }

        $this->questionRateRepository->delete($id);

        Flash::success('تم حذف السؤال بنجاح ');

        return redirect(route('questionRates.index'));
    }
}
