<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;
	protected $table = 'orders';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'customer_id' => 'int',
		'order_date' => 'datetime',
		'total_amount' => 'float'
	];

	protected $fillable = [
		'customer_id',
		'order_date',
		'total_amount',
		'payment_method',
		'status'
	];
}
