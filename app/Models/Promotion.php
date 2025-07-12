<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Promotion extends Model
{
	use HasFactory; // 👉 thêm dòng này
	protected $table = 'promotions';
	protected $fillable = [
		'name',
		'discount_percentage',
		'start_date',
		'end_date'
	];

	public function laptops(): BelongsToMany
	{
		return $this->belongsToMany(Laptop::class, 'laptop_promotions')
					->withPivot('start_date', 'end_date') 
					->withTimestamps();
	}
}
