<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'category_id',
        'author_id',
        'featured_image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(BlogPostCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(BlogAuthor::class, 'author_id');
    }
}
