<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductStore
 * @package App\Models
 * @version February 26, 2020, 11:07 am UTC
 *
 * @property \App\Models\Product product
 * @property \App\Models\Store store
 * @property integer product_id
 * @property integer store_id
 * @property integer price
 * @property string currency
 * @property integer deliveryPrice
 * @property number discount
 */
class ProductStore extends Model
{
    use SoftDeletes;

    public $table = 'product_stores';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'store_id',
        'price',
        'currency',
        'deliveryPrice',
        'discount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'store_id' => 'integer',
        'price' => 'integer',
        'currency' => 'string',
        'deliveryPrice' => 'integer',
        'discount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required',
        'store_id' => 'required',
        'price' => 'required',
        'currency' => 'required',
        // 'deliveryPrice' => 'required',
        'discount' => 'required'
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
