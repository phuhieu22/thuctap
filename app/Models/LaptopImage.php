<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopImage extends Model
{
    /** @use HasFactory<\Database\Factories\LaptopImageFactory> */
    use HasFactory;
    protected $table = 'laptop_images';
    protected $fillable = [
        'laptop_id',
        'url',
    ];
}
