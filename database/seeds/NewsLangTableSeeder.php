<?php

use Illuminate\Database\Seeder;

class NewsLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title_ar=
            [
               "تخفيضات واسعة على ممنتجات معرض نون" ,
                "عروض كثيرة الان في متجر مايكروسفت ",
                " اخر اصدار لجوالات شركة Apple",
            ];
        $title_en =[
                " the event of an order",
                " the order arrive on time",
                " what was described",
        ];

        $description_ar=[
            'يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى',
            'نفس المساحة، لقد تم توليد هذا النصنفس المساحة، لقد تم توليد هذا النصنفس المساحة، لقد تم توليد هذا النصنفس المساحة، لقد تم توليد هذا النصنفس المساحة، لقد تم توليد هذا النص  نفس المساحة، لقد تم توليد هذا النص',
            'يمكن   نفس المساحة، لقد تم توليد هذا النص أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى',
        ];
        $description_en=[
            'Lorem ipsum dolor, sit amet consectetur adipisicing , sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit ',
            ' consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor amet consectetur adipisicing eliLorem ipsum dolor, eliLorem ipsum dolor eliLorem ipsum dolor sit amet consectetur adipisicing eli',
            'amet consectetur sit amet consectetur sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum ',
        ];

        
        for ($i =0 ; $i<count($title_ar) ;$i++) {
            $new= \App\Models\News::create(['image'=>'tvs'.rand(1,10).'.png']);

           \App\Models\NewsLang::create([
               'title'=>$title_en[$i],
               'description'=>$description_en[$i],
               'lang_id'=>1, //en
               'new_id'=>$new->id,
           ]);

           \App\Models\NewsLang::create([
               'title'=>$title_ar[$i],
               'description'=>$description_ar[$i],
               'lang_id'=>2, //ar
               'new_id'=>$new->id,
           ]);


            }
    }
}
