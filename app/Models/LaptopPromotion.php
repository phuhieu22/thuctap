<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


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
