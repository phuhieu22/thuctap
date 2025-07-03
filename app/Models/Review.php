<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Review
 * 
 * @property int $id
 * @property int $laptop_id
 * @property int $customer_id
 * @property int $rating
 * @property string|null $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Review extends Model
{
	protected $table = 'reviews';

	// Xóa dòng public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'laptop_id' => 'int',
		'customer_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'laptop_id',
		'customer_id',
		'rating',
		'comment'
	];

	/**
	 * Một đánh giá thuộc về một laptop.
	 */
	public function laptop(): BelongsTo
	{
		return $this->belongsTo(Laptop::class);
	}

	/**
	 * Một đánh giá được viết bởi một khách hàng (User).
	 */
	public function customer(): BelongsTo
	{
		return $this->belongsTo(User::class, 'customer_id');
	}
}
