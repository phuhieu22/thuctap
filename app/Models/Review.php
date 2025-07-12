<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Review extends Model
{
	use HasFactory; // 👉 thêm dòng này
	protected $table = 'reviews';

	protected $fillable = [
		'laptop_id',
		'customer_id',
		'rating',
		'comment'
	];


	public function laptop(): BelongsTo
	{
		return $this->belongsTo(Laptop::class);
	}


	public function customer(): BelongsTo
	{
		return $this->belongsTo(User::class, 'customer_id');
	}
}
