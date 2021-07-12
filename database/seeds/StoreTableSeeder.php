<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Models\Store::class,2)->create();

        //1
       $store= \App\Models\Store::create([
            'img'=>'hm.png',
            'link'=>'www.hm.net',
            'city_id'=>'1',
            'user_id'=>'4',
        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'description' => "Lorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eli",
            'lang_id'=>1 ,
            'name'=>"HM"
        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'description' => "يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
            'lang_id'=>2 ,
            'name'=>"اتش ام"
        ]);

        //2
        $store= \App\Models\Store::create([
            'img'=>'microsoft.png',
            'link'=>'www.microsoft.net',
            'city_id'=>'1',
            'user_id'=>'5',

        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'description' => "Lorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eli",
            'lang_id'=>1 ,
            'name'=>"Microsoft"
        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'lang_id'=>2 ,
            'description' => "يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
            'name'=>"مايكروسوفت"
        ]);

        //3
        $store= \App\Models\Store::create([
            'img'=>'namshi.png',
            'link'=>'www.namshi.net',
            'city_id'=>'1',
            'user_id'=>'6',

        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'lang_id'=>1 ,
            'description' => "Lorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eli",
            'name'=>"Namshi"
        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'lang_id'=>2 ,
            'description' => "يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
            'name'=>"ناشامي"
        ]);

        //4
        $store= \App\Models\Store::create([
            'img'=>'nike.png',
            'link'=>'www.nike.net',
            'city_id'=>'1',
            'user_id'=>'7',

        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'lang_id'=>1 ,
            'description' => "Lorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eli",
            'name'=>"Nike"
        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'lang_id'=>2 ,
            'description' => "يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
            'name'=>"نايك"
        ]);

        //5
        $store= \App\Models\Store::create([
            'img'=>'noon.png',
            'link'=>'www.noon.net',
            'city_id'=>'1',
            'user_id'=>'8',

        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'lang_id'=>1 ,
            'description' => "Lorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eli",
            'name'=>"Noon"
        ]);
        \App\Models\StoreLang::create([
            'store_id'=>$store->id ,
            'lang_id'=>2 ,
            'description' => "يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
            'name'=>"نون"
        ]);
    }
}
