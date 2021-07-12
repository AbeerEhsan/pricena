<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionRateAnswer
 * @package App\Models
 * @version March 19, 2020, 1:35 am UTC
 *
 * @property \App\Models\QusetionRate question
 * @property \Illuminate\Database\Eloquent\Collection qusetionRateAnswerLangs
 * @property \Illuminate\Database\Eloquent\Collection userRates
 * @property integer question_id
 */
class QuestionRateAnswer extends Model
{
    use SoftDeletes;

    public $table = 'qusetion_rate_answers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'question_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function question()
    {
        return $this->belongsTo(\App\Models\QuestionRate::class, 'question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function qusetionRateAnswerLangs()
    {
        return $this->hasMany(\App\Models\QuestionRateAnswerLang::class, 'answer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function userRates()
    {
        return $this->hasMany(\App\Models\UserRate::class, 'answer_id');
    }
}
