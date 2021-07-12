<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 * @package App\Models
 * @version February 26, 2020, 11:11 am UTC
 *
 * @property string terms
 * @property string privacy
 * @property string phone
 * @property string email
 * @property string social
 */
class Setting extends Model
{
    use SoftDeletes;

    public $table = 'settings';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'terms',
        'privacy',
        'phone',
        'email',
        // 'social'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'terms' => 'string',
        'privacy' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'social' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'terms' => 'required',
        'privacy' => 'required',
        'phone' => 'required',
        'email' => 'required',
        // 'social' => 'required'
    ];

    
}
