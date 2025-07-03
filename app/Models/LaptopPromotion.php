<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LaptopPromotion
 * 
 * @property int $id
 * @property int $laptop_id
 * @property int $promotion_id
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class LaptopPromotion extends Model
{
	protected $table = 'laptop_promotions';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'laptop_id' => 'int',
		'promotion_id' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime'
	];

	protected $fillable = [
		'laptop_id',
		'promotion_id',
		'start_date',
		'end_date'
	];
}
