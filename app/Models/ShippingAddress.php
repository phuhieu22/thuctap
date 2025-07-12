<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ShippingAddress extends Model
{
	use HasFactory; // 👉 thêm dòng này
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
