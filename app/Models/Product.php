<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version February 26, 2020, 11:05 am UTC
 *
 * @property \App\Models\Category category
 * @property \Illuminate\Database\Eloquent\Collection cobons
 * @property \Illuminate\Database\Eloquent\Collection favourites
 * @property \Illuminate\Database\Eloquent\Collection offers
 * @property \Illuminate\Database\Eloquent\Collection productGalleries
 * @property \Illuminate\Database\Eloquent\Collection productLangs
 * @property \Illuminate\Database\Eloquent\Collection productStores
 * @property string sku
 * @property string img
 * @property integer category_id
 * @property string Barcode
 * @property string link
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'sku',
        'img',
        'category_id',
        'Barcode',
        'link'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sku' => 'string',
        'img' => 'string',
        'category_id' => 'integer',
        'Barcode' => 'string',
        'link' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sku' => 'required',
        // 'photo' => 'required',
        'category_id' => 'required',
        'Barcode' => 'required',
        'link' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cobons()
    {
        return $this->hasMany(\App\Models\Cobon::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function favourites()
    {
        return $this->hasMany(\App\Models\Favourite::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function offers()
    {
        return $this->hasMany(\App\Models\Offer::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productGalleries()
    {
        return $this->hasMany(\App\Models\ProductGallery::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productLangs()
    {
        return $this->hasMany(\App\Models\ProductLang::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productStores()
    {
        return $this->hasMany(\App\Models\ProductStore::class, 'product_id');
    }


    public function productPriceHistory()
    {
        return $this->hasMany(\App\Models\ProductPriceHistory::class, 'product_id');
    }


}
