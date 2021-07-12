<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cobons
 * @package App\Models
 * @version February 26, 2020, 11:10 am UTC
 *
 * @property \App\Models\Product product
 * @property \App\Models\Store store
 * @property string code
 * @property integer maxUser
 * @property integer product_id
 * @property integer store_id
 */
class Cobon extends Model
{
    use SoftDeletes;

    public $table = 'cobons';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'maxUser',
        'product_id',
        'store_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'maxUser' => 'integer',
        'product_id' => 'integer',
        'store_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'maxUser' => 'required',
        'product_id' => 'required',
        'store_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class, 'store_id');
    }
}
