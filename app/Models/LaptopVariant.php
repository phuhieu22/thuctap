<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaptopVariant extends Model
{
	protected $table = 'laptop_variants';

	protected $casts = [
		'laptop_id' => 'int',
		'price' => 'float',
		'stock' => 'int'
	];

	protected $fillable = [
		'laptop_id',
		'variant_name',
		'price',
		'stock',
		'specifications'
	];

	// THÊM HÀM QUAN HỆ
	public function laptop(): BelongsTo
	{
		return $this->belongsTo(Laptop::class);
	}
}
