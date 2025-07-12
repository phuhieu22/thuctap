<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class OrderItem extends Model
{
	protected $table = 'order_items';
	public $incrementing = false;

	protected $fillable = [
		'order_id',
		'laptop_id',
		'quantity',
		'price'
	];
}
