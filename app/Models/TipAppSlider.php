<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipAppSlider
 * @package App\Models
 * @version March 19, 2020, 1:36 am UTC
 *
 * @property string description
 * @property string image
 */
class TipAppSlider extends Model
{
    use SoftDeletes;

    public $table = 'tip_app_sliders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'description',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required',
        // 'image' => 'required'
    ];

    
}
