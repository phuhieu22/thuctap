<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{

	use HasFactory; // 👉 thêm dòng này

	protected $table = 'brands';

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function laptops(): HasMany
	{
		return $this->hasMany(Laptop::class);
	}
}
