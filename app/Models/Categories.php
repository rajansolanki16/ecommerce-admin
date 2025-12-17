<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }


}
