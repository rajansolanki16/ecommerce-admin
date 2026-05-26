<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogPost;

class BlogAuthor extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'email',
        'website',
        'bio',
        'profile_image',
    ];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }
}
