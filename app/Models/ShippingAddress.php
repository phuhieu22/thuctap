<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShippingAddress
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $order_id
 * @property string $address
 * @property string $city
 * @property string $postal_code
 * @property string $country
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ShippingAddress extends Model
{
	protected $table = 'shipping_addresses';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'customer_id' => 'int',
		'order_id' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'order_id',
		'address',
		'city',
		'postal_code',
		'country'
	];
}
