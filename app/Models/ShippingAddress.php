<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingAddressFactory> */
    use HasFactory;
    protected $table = 'shipping_addresses';
    protected $fillable = [
        'customer_id',
        'order_id',
        'address',
        'city',
        'postal_code',
        'country',
    ];
}
