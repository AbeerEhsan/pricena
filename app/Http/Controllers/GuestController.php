<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //

    public function privacy()
    {
        $privacy=Setting::first()->privacy;

        return view('settings',compact('privacy'));
    }
    public function contact_us()
    {
        $mobile=Setting::first()->phone;
        $email=Setting::first()->email;

        return view('settings',compact('email','mobile'));
    }
}
