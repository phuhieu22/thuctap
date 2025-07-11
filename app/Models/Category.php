<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Category extends Model
{
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
