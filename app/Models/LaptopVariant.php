<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopVariant extends Model
{
    /** @use HasFactory<\Database\Factories\LaptopVariantFactory> */
    use HasFactory;
    protected $table = 'laptop_variants';
    protected $fillable = [
        'laptop_id',
        'variant_name',
        'price',
        'stock',
        'specifications',

    ];

        public function laptop()
{
    return $this->belongsTo(Laptop::class);
}

}
