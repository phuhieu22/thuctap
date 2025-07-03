<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Promotion
 * 
 * @property int $id
 * @property string $name
 * @property float $discount_percentage
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Promotion extends Model
{
	protected $table = 'promotions';

	protected $casts = [
		'id' => 'int',
		'discount_percentage' => 'float',
		'start_date' => 'datetime',
		'end_date' => 'datetime'
	];

	protected $fillable = [
		'name',
		'discount_percentage',
		'start_date',
		'end_date'
	];

	/**
	 * Một khuyến mãi có thể áp dụng cho nhiều laptop.
	 */
	public function laptops(): BelongsToMany
	{
		return $this->belongsToMany(Laptop::class, 'laptop_promotions')
					->withPivot('start_date', 'end_date') // Lấy thêm các cột trong bảng trung gian
					->withTimestamps();
	}
}
