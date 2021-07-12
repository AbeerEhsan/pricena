<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Favourite
 * @package App\Models
 * @version February 26, 2020, 11:07 am UTC
 *
 * @property \App\Models\Product product
 * @property \App\Models\Store store
 * @property \App\Models\User user
 * @property integer user_id
 * @property string rating
 * @property integer store_id
 * @property integer product_id
 */
class Favourite extends Model
{
//    use SoftDeletes;

    public $table = 'favourites';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


//    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'rating',
        'store_id',
        'product_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'rating' => 'string',
        'store_id' => 'integer',
        'product_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'rating' => 'required',
        'store_id' => 'required',
        'product_id' => 'required'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
