<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaptopImage extends Model
{
	use HasFactory; // 👉 thêm dòng này
	protected $table = 'laptop_images';


	protected $casts = [
		'id' => 'int',
		'laptop_id' => 'int'
	];

	protected $fillable = [
		'laptop_id',
		'url'
	];

	public function laptop(): BelongsTo
	{
		return $this->belongsTo(Laptop::class);
	}
}
