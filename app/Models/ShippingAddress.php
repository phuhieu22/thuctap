<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class ShippingAddress extends Model
{
	protected $table = 'shipping_addresses';
	public $incrementing = false;

	protected $fillable = [
		'customer_id',
		'order_id',
		'address',
		'city',
		'postal_code',
		'country'
	];
}
