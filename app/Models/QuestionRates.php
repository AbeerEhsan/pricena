<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionRates
 * @package App\Models
 * @version March 19, 2020, 1:34 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection qusetionRateAnswers
 * @property \Illuminate\Database\Eloquent\Collection qusetionRateLangs
 * @property integer order
 */
class QuestionRates extends Model
{
    use SoftDeletes;

    public $table = 'qusetion_rates';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function qusetionRateAnswers()
    {
        return $this->hasMany(\App\Models\QuestionRateAnswer::class, 'question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function qusetionRateLangs()
    {
        return $this->hasMany(\App\Models\QusetionRateLang::class, 'question_id');
    }
}
