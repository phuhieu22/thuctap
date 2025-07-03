<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * 
 * @property int $id
 * @property int $customer_id
 * @property Carbon $order_date
 * @property float $total_amount
 * @property string|null $payment_method
 * @property string $status
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
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
