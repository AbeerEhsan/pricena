<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationLang extends Model
{
    //
    protected $fillable =[
        'notification_id' ,'lang_id','data'
    ];
}
