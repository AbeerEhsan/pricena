<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Offer
 * @package App\Models
 * @version February 26, 2020, 11:09 am UTC
 *
 * @property \App\Models\Product product
 * @property \App\Models\Store store
 * @property \Illuminate\Database\Eloquent\Collection sliders
 * @property integer product_id
 * @property integer store_id
 * @property string link
 * @property number discount
 */
class Offer extends Model
{
    use SoftDeletes;

    public $table = 'offers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'store_id',
        'is_star',
        'link',
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
        'link' => 'string',
        'discount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required',
        // 'store_id' => 'required',
        'link' => 'required',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sliders()
    {
        return $this->hasMany(\App\Models\Slider::class, 'offer_id');
    }
}
