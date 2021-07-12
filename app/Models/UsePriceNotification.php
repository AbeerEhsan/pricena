<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsePriceNotification extends Model
{
    //
    protected $fillable =[
        'user_id' ,'price', 'product_id'
    ];
}
