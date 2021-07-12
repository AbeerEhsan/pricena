<?php

use Illuminate\Database\Seeder;

class QuestionRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $qusetions_ar=
            [
               "هل تم التواصل معك بشكل مستمر في حالة الطلب ؟" ,
                "هل وصل الطلب في الوقت المحدد ؟",
                "هل تلقيت الطلب مطابقا لما تم وصفه ؟",
                "هل ستشتري مرة اخرى من المتجر ؟",
            ];
        $qusetions_en =[
                "Have you been contacted continuously in the event of an order?",
                "Did the order arrive on time?",
                "Did you receive the order in accordance with what was described?",
                "Would you buy again from the store?",
        ];

        $answers_ar=[
            'نعم',
            'لا',
            'احيانا',
            'نوعا ما',
        ];
        $answers_en=[
            'Yes',
            'No',
            'Sometimes',
            'Sometimes Yes',
        ];

        for ($i =0 ; $i<count($qusetions_ar) ;$i++) {
           $question= \App\Models\QuestionRate::create(['order' =>$i+1]);

           \App\Models\QuestionRateLang::create([
               'question'=>$qusetions_en[$i],
               'lang_id'=>1, //en
               'question_id'=>$question->id,
           ]);

           \App\Models\QuestionRateLang::create([
               'question'=>$qusetions_ar[$i],
               'lang_id'=>2, //ar
               'question_id'=>$question->id,
           ]);

            for ($j =0 ; $j<rand(2,3) ;$j++) {
               $answer= \App\Models\QuestionRateAnswer::create([
                    'question_id'=>$question->id,
                ]);

                \App\Models\QuestionRateAnswerLang::create([
                    'answer_id'=>$answer->id,
                    'lang_id'=>1, //en
                    'answer'=>$answers_en[$j],
                ]);
                \App\Models\QuestionRateAnswerLang::create([
                    'answer_id'=>$answer->id,
                    'lang_id'=>2, //ar
                    'answer'=>$answers_ar[$j],
                ]);
            }

            }
    }
}
