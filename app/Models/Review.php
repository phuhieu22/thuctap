<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'laptop_id',
        'customer_id',
        'rating',
        'comment',
    ];
}
