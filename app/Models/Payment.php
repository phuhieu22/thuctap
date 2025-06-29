<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'amount',
        'payment_date',
        'status',
        'payment_method',
    ];
}
