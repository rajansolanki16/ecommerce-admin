<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    
    protected $fillable = [
        'product_title',
        'slug',
        'product_type',
        'short_description',
        'brand',
        'exchangeable',
        'refundable',
        'product_decscription',
        'product_image',
        'gallery_images',
        'manufacturer_name',
        'manufacturer_brand',
        'stock',
        'price',
        'discount',
        'status',
        'visibility',
    ];

}
