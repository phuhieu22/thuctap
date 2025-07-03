<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'model',
        'price',
        'original_price',
        'stock',
        'description',
        'short_description',
        'specifications',
        'features',
        'is_active',
    ];

    protected $casts = [
        'specifications' => 'array',
        'features' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(LaptopImage::class);
    }

    public function variants()
    {
        return $this->hasMany(LaptopVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->original_price && $this->original_price > $this->price) {
            return round((($this->original_price - $this->price) / $this->original_price) * 100);
        }
        return 0;
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews->avg('rating') ?? 0;
    }

    public function getMainImageAttribute()
    {
        return $this->images->first()?->image_path ?? '/images/placeholder.jpg';
    }
}
