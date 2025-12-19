<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute_values extends Model
{
    //
    protected $table = 'attribute_values';
    protected $fillable = ['product_attribute_id', 'value','slug'];

    public function productAttribute()
    {
        return $this->belongsTo(Product_Attribute::class, 'product_attribute_id');
    }
}
