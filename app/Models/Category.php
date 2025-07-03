<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';
	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	/**
	 * Một danh mục có nhiều laptop.
	 */
	public function laptops(): HasMany
	{
		return $this->hasMany(Laptop::class);
	}
}
