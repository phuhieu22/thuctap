<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopPromotion extends Model
{
    /** @use HasFactory<\Database\Factories\LaptopPromotionFactory> */
    use HasFactory;
    protected $table = 'laptop_promotions';
    protected $fillable = [
        'laptop_id',
        'promotion_id',
        'start_date',
        'end_date',
    ];
}
