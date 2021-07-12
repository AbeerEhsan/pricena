<?php

use Illuminate\Database\Seeder;
use \App\Models\Category;
use \App\Models\CategoryLanguage;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Models\Category::class,20)->create();

        $images=['mobiles.png','offices.png','computers.png','cameras.png','tvs.png'
                  ,'games.png','books.png','makups.png','bags.png'
                  ,'perfums.png','sports.png','headsets.png','houses.png','tools.png','markets.png'];

        $ar=['جوالات','مستلزمات المكاتب','اجهزة كومبيوتر','كاميرات','تلفاز'
            ,'العاب الفيديو','كتب','مستحضرات تجميل ولوازم البشرة','حقائب'
            ,'عطور','مستلزمات رياضية','صوتيات','مستلزمات المنزل','ادوات و معدات','بقالة'];

        $en=['Mobiles',' Office Requirements','Computers','Cameras','Tv'
            ,'Video Games','Books','Makeups','Bags'
            ,'Perfumes','Sports Requirements','Audios Requirements','House Requirements','Tools and Requirements','Market'];

        $ar_sub_cat=[
            'جوالات سامسونج','جوالات iphones','جوالات نوكيا','جوالات هاواوي',
            'مكاتب اطفال','مكاتب شركات','مستلزمات مكتبية','مكاتب مدرسية',
            ' سامسونج','Dell ديل',' HP','Lenova',
            'كاميرات سامسونج','كاميرات سوني sony','كاميرات نوكيا','كاميرات canon',
            'سامسونج','LG ال جي','نوكيا','سوني Sony',
            'بلاي ستيشن سامسونج','بلاي ستيشن 5',' بلاي ستيشن 3',' بلاي ستيشن سوني Sony',
            'كتب علمية','كتب ثقافية','قصص و روايات','قصص اطفال',
            'مستحضرات تجميل','مستحضرات رجال','مستحضرات نساء','مستحضرات اطفال',
            'حقائب مدرسية','حقائب نسائية','حقائب رجال','حقائب منوعة',
            'عطور رجالي','عطور نسائي','عطور اطفال','عطور و بخور',
            'معدات رياضية','اجهزة رياضية','كرة قدم','كرة سلة',
            'سماعات خارجية','سماعات جوالات','سماعات ملونة','اجهزة صوتيات',
            'كنب واثاث','تحف','هدايا','غرف و اثاث',
            'معدات','ادوات','ادوات الكترونية','ادوات كهربائية',
            'لحوم و اسماك','منتجات غذائية','عصائر','اطعمة طازجة',
        ];
        $en_sub_cat=[
            'Sumsung Mobiles','iphones Mobiles','Nokia Mobiles','HUAWEI Mobiles',
            'Children Offices','Companies Offices','Office Requirements','School Offices',
            ' Sumsung','Dell ',' HP','Lenova',
            'Sumsung Cameras','Sony Cameras','Nokia Cameras','Canon Cameras',
            'Sumsung TVs','LG TVs','Nokia Tvs','Sony TVs',
            'Sumsung PlayStations',"PlayStations 5",'PlayStations 3','PlayStations Sony',
            'Scientific Books','Cultural Books','Stories and Novels','Children Stories',
            'Makeups','Men Requirements','Ladies Requirements','Children Requirements',
            'School Bags','Ladies Bags','Men Bags','Bags',
            'Men Perfumes','Ladies Perfumes','Children Perfumes','Perfumes and Incenses',
            'Sports Requirements','Sports Tools','Football','Basketball',
            'External Headphones','Mobiles Headphones','Headphones','Audio Devices',
            'Sofs and Furniture','Masterpiece','Gifts','Furniture',
            'Equipment','Tools','Electronic Tools','Electric Tools',
            'Meat and fishes','food','Juices','Fresh Food',
        ];
        $i=0;
        $k=0;
        $index=0;

        foreach ($images as $image) {
            $j=0;

            // Main Categories and langs
            $category= Category::create(
                [
                    'img' => $image ,
                    'parent_id' => null
                ]
            );

            CategoryLanguage::create([
                'category_id'=>$category->id ,
                'name'=>$ar[$i],
                'lang_id'=>'2' //ar
            ]);

            CategoryLanguage::create([
                'category_id'=>$category->id ,
                'name'=>$en[$i],
                'lang_id'=>'1' //en
            ]);


            while(($j == 0) || ($j % 4) != 0)
            {
                $sub_category= Category::create(
                    [
                        'parent_id' => $category->id
                    ]
                );
                CategoryLanguage::create([
                    'category_id'=>$sub_category->id ,
                    'name'=>$ar_sub_cat[$index],
                    'lang_id'=>'2' //ar
                ]);

                CategoryLanguage::create([
                    'category_id'=>$sub_category->id ,
                    'name'=>$en_sub_cat[$index],
                    'lang_id'=>'1' //en
                ]);

                $j++;
                $k++;

                $index = $k;

            }

         $i++;
        }
    }
}
