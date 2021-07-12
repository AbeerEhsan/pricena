<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRate extends Model
{
    //
    protected $fillable =[
        'user_id','answer_id'
    ];
}
