<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
	use HasFactory; // 👉 thêm dòng này
	protected $table = 'categories';
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
