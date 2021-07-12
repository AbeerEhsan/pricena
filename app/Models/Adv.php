<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Adv
 * @package App\Models
 * @version April 25, 2020, 8:21 am UTC
 *
 * @property string media_link
 * @property string type
 * @property string description
 * @property string link
 * @property boolean is_active
 */
class Adv extends Model
{
    use SoftDeletes;

    public $table = 'advs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'media_link',
        'type',
        'description',
        'link',
        'is_active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'media_link' => 'string',
        'type' => 'string',
        'description' => 'string',
        'link' => 'string',
        'is_active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'is_active' => 'required'
    ];

    
}
