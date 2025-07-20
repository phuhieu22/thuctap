<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable = [
        'customer_id',
        'order_id',
        'address',
        'city',
        'postal_code',
        'country',
    ];
}
