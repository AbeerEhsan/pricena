<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class News
 * @package App\Models
 * @version February 26, 2020, 11:10 am UTC
 *
 * @property \App\Models\Language lang
 * @property string title
 * @property string description
 * @property integer lang_id
 */
class NewsEmail extends Model
{
    use SoftDeletes;

    public $table = 'news_email';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'email',
      
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'id' => 'integer',
    //     'title' => 'string',
    //     'description' => 'string',
    //     'lang_id' => 'integer'
    // ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required'
    ];

  
}
