<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SliderLang
 * @package App\Models
 * @version February 26, 2020, 11:11 am UTC
 *
 * @property \App\Models\Language lang
 * @property \App\Models\Slider slider
 * @property string description
 * @property integer slider_id
 * @property integer lang_id
 */
class SliderLang extends Model
{
    use SoftDeletes;

    public $table = 'slider_langs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'description',
        'slider_id',
        'lang_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'slider_id' => 'integer',
        'lang_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required',
        'slider_id' => 'required',
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
    public function slider()
    {
        return $this->belongsTo(\App\Models\Slider::class, 'slider_id');
    }
}
