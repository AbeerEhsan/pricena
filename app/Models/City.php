<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 * @package App\Models
 * @version February 26, 2020, 11:01 am UTC
 *
 * @property \App\Models\Country country
 * @property \App\Models\Language lang
 * @property \Illuminate\Database\Eloquent\Collection stores
 * @property string name
 * @property integer lang_id
 * @property integer country_id
 */
class City extends Model
{
    use SoftDeletes;

    public $table = 'cities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'lang_id',
        'country_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'lang_id' => 'integer',
        'country_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'lang_id' => 'required',
        'country_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function lang()
    {
        return $this->belongsTo(\App\Models\Language::class, 'lang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stores()
    {
        return $this->hasMany(\App\Models\Store::class, 'city_id');
    }
}
