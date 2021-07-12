<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 * @package App\Models
 * @version February 26, 2020, 11:00 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection answers
 * @property \Illuminate\Database\Eloquent\Collection cities
 * @property \Illuminate\Database\Eloquent\Collection countries
 * @property \Illuminate\Database\Eloquent\Collection news
 * @property \Illuminate\Database\Eloquent\Collection notificationLangs
 * @property \Illuminate\Database\Eloquent\Collection productLangs
 * @property \Illuminate\Database\Eloquent\Collection questions
 * @property \Illuminate\Database\Eloquent\Collection sliderLangs
 * @property \Illuminate\Database\Eloquent\Collection storeLangs
 * @property string name
 * @property string symbol
 */
class Language extends Model
{
    use SoftDeletes;

    public $table = 'languages';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'symbol'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'symbol' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'symbol' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function answers()
    {
        return $this->hasMany(\App\Models\Answer::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cities()
    {
        return $this->hasMany(\App\Models\City::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function countries()
    {
        return $this->hasMany(\App\Models\Country::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function news()
    {
        return $this->hasMany(\App\Models\News::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notificationLangs()
    {
        return $this->hasMany(\App\Models\NotificationLang::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productLangs()
    {
        return $this->hasMany(\App\Models\ProductLang::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function questions()
    {
        return $this->hasMany(\App\Models\Question::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sliderLangs()
    {
        return $this->hasMany(\App\Models\SliderLang::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function storeLangs()
    {
        return $this->hasMany(\App\Models\StoreLang::class, 'lang_id');
    }
}
