<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //
    protected $fillable =[
        'user_id','rate','description','store_id','mobile','order_number','product_id'
    ];

    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class, 'store_id');
    }
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}
