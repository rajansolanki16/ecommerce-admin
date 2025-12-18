<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = [
        'product_title',
        'slug',
        'product_type',
        'short_description',
        'product_decscription',
        'brand',
        'exchangeable',
        'refundable',
        'manufacturer_name',
        'manufacturer_brand',
        'stock',
        'price',
        'discount',
        'status',
        'visibility',
        'product_image',
        'gallery_images',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'exchangeable'   => 'boolean',
        'refundable'     => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
