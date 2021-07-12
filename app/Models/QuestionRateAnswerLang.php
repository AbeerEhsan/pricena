<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionRateAnswerLang
 * @package App\Models
 * @version March 19, 2020, 1:35 am UTC
 *
 * @property \App\Models\QusetionRateAnswer answer
 * @property \App\Models\Language lang
 * @property integer answer_id
 * @property integer lang_id
 */
class QuestionRateAnswerLang extends Model
{
    use SoftDeletes;

    public $table = 'qusetion_rate_answer_langs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'answer_id',
        'answer',
        'lang_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'answer_id' => 'integer',
        'lang_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'answer_id' => 'required',
        'lang_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function answer()
    {
        return $this->belongsTo(\App\Models\QusetionRateAnswer::class, 'answer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function lang()
    {
        return $this->belongsTo(\App\Models\Language::class, 'lang_id');
    }
}
