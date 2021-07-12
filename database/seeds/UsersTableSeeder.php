<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = App\Models\User::create(
            [
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>bcrypt('123123'),
                'type'=>'admin',
                'img'=>'no-img-user.png'
            ]
        );

        App\Models\User::create(
            [
                'name'=>'Abeer',
                'email'=>'abeer@test.com',
                'password'=>bcrypt('123123'),
                'type'=>'user',
                'img'=>'no-img-user.png'

            ]
        );
        App\Models\User::create(
            [
                'name'=>'Dina',
                'email'=>'dina@test.com',
                'password'=>bcrypt('123123'),
                'type'=>'user',
                'img'=>'no-img-user.png'

            ]
        );

        // App\Models\User::create(
        //     [
        //         'name'=>'Ahmad said',
        //         'email'=>'hm@test.com',
        //         'password'=>bcrypt('123123'),
        //         'type'=>'store',
        //         'img'=>'no-img-user.png'

        //     ]
        // );
      
        // App\Models\User::create(
        //     [
        //         'name'=>'Dina store',
        //         'email'=>'microsft@test.com',
        //         'password'=>bcrypt('123123'),
        //         'type'=>'store',
        //         'img'=>'no-img-user.png'

        //     ]
        // );
      
        // App\Models\User::create(
        //     [
        //         'name'=>'Noor',
        //         'email'=>'namshi@test.com',
        //         'password'=>bcrypt('123123'),
        //         'type'=>'store',
        //         'img'=>'no-img-user.png'

        //     ]
        // );
      
        // App\Models\User::create(
        //     [
        //         'name'=>'Omar Store',
        //         'email'=>'nike@test.com',
        //         'password'=>bcrypt('123123'),
        //         'type'=>'store',
        //         'img'=>'no-img-user.png'

        //     ]
        // );
      
        // App\Models\User::create(
        //     [
        //         'name'=>'Ahmad Store',
        //         'email'=>'noon@test.com',
        //         'password'=>bcrypt('123123'),
        //         'type'=>'store',
        //         'img'=>'no-img-user.png'

        //     ]
        // );
      

        // factory(App\Models\User::class,20)->create();
    }
}
