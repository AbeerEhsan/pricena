<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductLang
 * @package App\Models
 * @version February 26, 2020, 11:06 am UTC
 *
 * @property \App\Models\Language lang
 * @property \App\Models\Product product
 * @property integer product_id
 * @property integer lang_id
 * @property string name
 * @property string description
 * @property string details
 */
class ProductLang extends Model
{
    use SoftDeletes;

    public $table = 'product_langs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'lang_id',
        'name',
        'description',
        'details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'lang_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required',
        'lang_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'details' => 'required'
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
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}
