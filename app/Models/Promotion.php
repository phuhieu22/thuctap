<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /** @use HasFactory<\Database\Factories\PromotionFactory> */
    use HasFactory;
    protected $table = 'promotions';
    protected $fillable = [
        'name',
        'discount_percentage',
        'start_date',
        'end_date',
    ];
}
