<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_Options extends Model
{
    //
    protected $table = 'payment_options';
    protected $fillable = [
        'paymet_type',
        'is_active'
    ];
}
