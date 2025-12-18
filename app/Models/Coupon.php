<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //

    protected $table = 'coupon';
    protected $fillable = [
        'code',
        'description',
        'type',
        'amount',
        'discount_amount',
        'start_date',
        'expiry_date',
        'max_usage',
    ];


}
