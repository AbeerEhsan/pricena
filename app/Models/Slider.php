<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Slider
 * @package App\Models
 * @version February 26, 2020, 11:11 am UTC
 *
 * @property \App\Models\Offer offer
 * @property \Illuminate\Database\Eloquent\Collection sliderLangs
 * @property string img
 * @property string link
 * @property integer offer_id
 */
class Slider extends Model
{
    use SoftDeletes;

    public $table = 'sliders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'img',
        'link',
        'offer_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'img' => 'string',
        'link' => 'string',
        'offer_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'link' => 'required',
        'offer_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function offer()
    {
        return $this->belongsTo(\App\Models\Offer::class, 'offer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sliderLangs()
    {
        return $this->hasMany(\App\Models\SliderLang::class, 'slider_id');
    }
}
