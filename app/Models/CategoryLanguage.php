<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CategoryLanguage
 * @package App\Models
 * @version February 26, 2020, 11:03 am UTC
 *
 * @property \App\Models\Category category
 * @property integer category_id
 * @property string name
 * @property integer lang_id
 * @property string description
 */
class CategoryLanguage extends Model
{
    use SoftDeletes;

    public $table = 'category_langs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'category_id',
        'name',
        'slug',
        'url',
        'lang_id',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'name' => 'string',
        'lang_id' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id' => 'required',
        'name' => 'required',
        'lang_id' => 'required',
        'description' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

      public function lang()
    {
        return $this->belongsTo(\App\Models\Language::class, 'lang_id');
    }

}
