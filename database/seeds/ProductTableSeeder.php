<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Models\Product::class,5)->create();

        $categories = \App\Models\Category::whereNotNull('parent_id')->get();

        $details_ar=[
            [
                "الموجات"=>"LTE" ,
                "اللون"=>"ابيض , زهري , اسود" ,
                "حجم الشاشة"=>"1.6 انش" ,
                "السعة"=>"520 GB" ,
                "ذاكرة الرام"=>"520 GB" ,

            ],
            [
                "اللون"=>"ابيض , احمر , اخضر",
                "الجودة"=>"عالية",
            ] ,
            [
                "اللون"=>"ابيض , احمر , ازرق , اصفر",
                "الجودة"=>"متوسطة",
            ]
        ];
        $details_en=[
            [
                "waves"=>"LTE" ,
                "color"=>"White , Pink , Black" ,
                "Size"=>"1.6 INSH" ,
                "Capacity"=>"520 GB" ,
                "RAM Memory"=>"520 GB" ,

            ],
            [
                "Color"=>"White , Red , Green",
                "Quality"=>"عالية",
            ] ,
            [
                "Color"=>"White , Red , Blue , Yellow",
                "Quality"=>"Meduim",
            ]
        ];

        foreach ($categories as $key=>$category)
        {
            $main_cat=\App\Models\Category::find($category->parent_id);

            $cat_lang_en=\App\Models\CategoryLanguage::where('category_id',$category->id)->where('lang_id',1)->first();
            $cat_lang_ar=\App\Models\CategoryLanguage::where('category_id',$category->id)->where('lang_id',2)->first();

            $image_cat=explode('.',$main_cat->img);

            $is_main=0;
            $details=rand(0,2);
            if($image_cat[0] == "mobiles" || $image_cat[0] == "tvs") {
                $is_main = 1;
                $details=0;
            }
            for ($j=0 ;$j<=rand(3,7);$j++) {
                $make_offer=rand(0,1);

                $product = \App\Models\Product::create(
                    [
                        'sku' => substr((microtime()), rand(0, 5), 5),
                        'img' => $image_cat[0] . rand(1, 10) . ".png",
                        'category_id' => $category->id,
                        'Barcode' => substr((microtime()), rand(0, 8), 8),
                        'is_main'=>$is_main,
                        'link' => "https:://www.products.com",
                    ]
                );

                // add store#1 to product 
                $product_store=\App\Models\ProductStore::create([
                    'product_id' => $product->id,
                    'store_id' => rand(1, 4),
                    'currency' => '$',
                    'price' => rand(100, 5000),
                    'discount' => rand(100, 5000),
                    'deliveryPrice' => rand(100, 5000),

                ]);

                // add store#2 to product 
                $product_store = \App\Models\ProductStore::create([
                    'product_id' => $product->id,
                    'store_id' => rand(1, 4),
                    'currency' => '$',
                    'price' => rand(100, 5000),
                    'discount' => rand(100, 5000),
                    'deliveryPrice' => rand(100, 5000),

                ]);

                // add store#3 to product 
                $product_store = \App\Models\ProductStore::create([
                    'product_id' => $product->id,
                    'store_id' => rand(1, 4),
                    'currency' => '$',
                    'price' => rand(100, 5000),
                    'discount' => rand(100, 5000),
                    'deliveryPrice' => rand(100, 5000),

                ]);

                //add offer
                if($make_offer == 1)
                \App\Models\Offer::create([
                    'product_id'=>$product->id ,
                    'store_id'=>$product_store->store_id ,
                    'discount'=>rand(5,90)
                ]);

                \App\Models\ProductLang::create(
                    [
                        'product_id' => $product->id,
                        'lang_id' => 1,//en
                        'name' => $cat_lang_en->name . " " . $j,
                        'details'=>json_encode($details_en[$details] ),
                        'description' => "Lorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eliLorem ipsum dolor, sit amet consectetur adipisicing eli",
                    ]
                );
                \App\Models\ProductLang::create(
                    [
                        'product_id' => $product->id,
                        'lang_id' => 2,//ar
                        'name' => $cat_lang_ar->name . " " . $j,
                        'details'=> json_encode($details_ar[$details]),
                        'description' => "يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربىيمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
                    ]
                );

                // add images gallery
                for ($i = 0; $i <= rand(2, 5); $i++) {
                    \App\Models\ProductGallery::create(
                        [
                            'product_id' => $product->id,
                            'img' => $image_cat[0] . rand(1, 10) . ".png",
                        ]
                    );
                }

                // add archive price history
                $dates=['20-03-2019','20-05-2019','05-07-2019','15-09-2019','22-11-2019','20-12-2019','12-01-2019','20-02-2019'];

                foreach ($dates as $date)
                {
                    \App\Models\ProductPriceHistory::create([
                        'product_id'=>$product->id ,
                        'date'=>$date ,
                        'price'=> rand(200,1000)
                    ]);
                }
            }
        }
    }
}
