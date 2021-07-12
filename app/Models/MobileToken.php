<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileToken extends Model
{
    //
    public $fillable = ['user_id','exponent_push_token'];

}
