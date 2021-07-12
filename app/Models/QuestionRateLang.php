<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionRateLang
 * @package App\Models
 * @version March 19, 2020, 1:34 am UTC
 *
 * @property \App\Models\Language lang
 * @property \App\Models\QusetionRate question
 * @property string question
 * @property integer question_id
 * @property integer lang_id
 */
class QuestionRateLang extends Model
{
    use SoftDeletes;

    public $table = 'qusetion_rate_langs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'question',
        'question_id',
        'lang_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question' => 'string',
        'question_id' => 'integer',
        'lang_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question' => 'required',
        'question_id' => 'required',
        'lang_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function lang()
    {
        return $this->belongsTo(\App\Models\Language::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function question()
    {
        return $this->belongsTo(\App\Models\QusetionRate::class, 'question_id');
    }
}
