<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Attribute extends Model
{
    //
    protected $table = 'product_attribute';

    protected $fillable = [
        'name',
        'slug',
    ];  

    public function values()
    {
        return $this->hasMany(Attribute_values::class, 'product_attribute_id');
    }
}
