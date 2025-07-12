<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaptopVariant extends Model
{
	use HasFactory; // 👉 thêm dòng này
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

	public function laptop(): BelongsTo
	{
		return $this->belongsTo(Laptop::class);
	}
}
