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
	use SoftDeletes; // Giữ lại vì có cột deleted_at

	protected $table = 'laptops';

	// XÓA DÒNG public $incrementing = false;

	protected $casts = [
		'brand_id' => 'int',
		'category_id' => 'int',
		'price' => 'float',
		'stock' => 'int'
	];

	protected $fillable = [
		'brand_id',
		'category_id',
		'model',
		'price',
		'stock',
		'description'
	];

	// THÊM CÁC HÀM QUAN HỆ
	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class); // Giả sử bạn có model Category
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
}
