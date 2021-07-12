<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        if($user){
            if($user->type == 'admin'){

                $users_count=User::where('type','user')->count();
                $products_count=Product::count();
                $offers_count=Offer::count();
                $store_count=Store::count();
        
                $latest_users=User::where('type','user')->orderByDesc('created_at')->limit(12)->get();
                $latest_products=Product::orderByDesc('created_at')->limit(6)->get();
        
                return view('home' ,compact('users_count','products_count','offers_count'
                    ,'store_count','latest_users','latest_products'));


            } elseif($user->type == 'store'){
                $products_count=Store::where('user_id',Auth::user()->id)->first()->productStores->count() ;
                $offers_count=Store::where('user_id',Auth::user()->id)->first()->offers->count() ;
        
                $latest_products=Product::whereIn('id', Store::where('user_id',Auth::user()->id)->first()->productStores )
                ->orderByDesc('created_at')->limit(4)->get();
               
                $latest_offers=Offer::whereIn('id', Store::where('user_id',Auth::user()->id)->first()->offers )
                ->orderByDesc('created_at')->limit(4)->get();
                
                return view('store_home' ,compact('products_count','offers_count'
                ,'latest_products','latest_offers'));
        }
            else{ 
                return redirect('/user_home');
     
    }
}}


    // public function index()
    // {
    //     $users_count=User::where('type','user')->count();
    //     $products_count=Product::count();
    //     $offers_count=Offer::count();
    //     $store_count=Store::count();

    //     $latest_users=User::where('type','user')->orderByDesc('created_at')->limit(12)->get();
    //     $latest_products=Product::orderByDesc('created_at')->limit(6)->get();

    //     return view('home' ,compact('users_count','products_count','offers_count'
    //         ,'store_count','latest_users','latest_products'));
    // }


}
