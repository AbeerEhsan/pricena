<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version February 26, 2020, 11:03 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection categoryLangs
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property string img
 * @property integer parent_id
 */
class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'img',
        'parent_id',
        'pageCount',
        'productCount',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'img' => 'string',
        'parent_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'photo' => 'required',
        // 'parent_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function categoryLangs()
    {
        return $this->hasMany(\App\Models\CategoryLanguage::class, 'category_id')
        ->where('lang_id','=',request('lang')??'2');

    }
    public function categoryLanguage()
    {
        return $this->hasMany(\App\Models\CategoryLanguage::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'category_id');
    }

      public function parent()
    {
        return $this->belongsTo(CategoryLanguage::class,'parent_id','category_id')
        ->where('lang_id','=',request('lang')??'2');
    }
    public function child()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }


}
