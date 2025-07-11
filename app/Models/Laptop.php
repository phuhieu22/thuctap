<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Laptop extends Model
{
	use SoftDeletes; 

	protected $table = 'laptops';

	protected $fillable = [
		'brand_id',
		'category_id',
		'model',
		'price',
		'stock',
		'description'
	];

	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class); 
	}

	public function images(): HasMany
	{
		return $this->hasMany(LaptopImage::class);
	}

	public function variants(): HasMany
	{
		return $this->hasMany(LaptopVariant::class);
	}
	
	public function promotions(): BelongsToMany
  {
        return $this->belongsToMany(Promotion::class, 'laptop_promotions');
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
