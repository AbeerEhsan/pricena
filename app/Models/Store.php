<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Store
 * @package App\Models
 * @version February 26, 2020, 11:02 am UTC
 *
 * @property \App\Models\City city
 * @property \Illuminate\Database\Eloquent\Collection cobons
 * @property \Illuminate\Database\Eloquent\Collection favourites
 * @property \Illuminate\Database\Eloquent\Collection offers
 * @property \Illuminate\Database\Eloquent\Collection productStores
 * @property \Illuminate\Database\Eloquent\Collection storeLangs
 * @property string img
 * @property string link
 * @property integer city_id
 */
class Store extends Model
{
    use SoftDeletes;

    public $table = 'stores';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'img',
        'link',
        'location',
        'city_id',
        'user_id',
        'access_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'img' => 'string',
        'link' => 'string',
        'city_id' => 'integer',
        'user_id' => 'integer'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'photo' => 'required',
        'link' => 'required',
        'city_id' => 'required',
//        'user_id' => 'required'
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cobons()
    {
        return $this->hasMany(\App\Models\Cobon::class, 'store_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function favourites()
    {
        return $this->hasMany(\App\Models\Favourite::class, 'store_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function offers()
    {
        return $this->hasMany(\App\Models\Offer::class, 'store_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productStores()
    {
        return $this->hasMany(\App\Models\ProductStore::class, 'store_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function storeLangs()
    {
        return $this->hasMany(\App\Models\StoreLang::class, 'store_id');
    }

    // public function translation($language = null)
    //     {
    //         if ($language == null) {
    //             $language = App::getLocale();
    //         }
    //         return $this->hasMany(\App\Models\StoreLang::class, 'store_id')->where('language', '=', $language);
    //     }

}
