<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class LaptopImage
 * 
 * @property int $id
 * @property int $laptop_id
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class LaptopImage extends Model
{
	protected $table = 'laptop_images';

	// Xóa dòng public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'laptop_id' => 'int'
	];

	protected $fillable = [
		'laptop_id',
		'url'
	];

	/**
	 * Một ảnh thuộc về một laptop.
	 */
	public function laptop(): BelongsTo
	{
		return $this->belongsTo(Laptop::class);
	}
}
