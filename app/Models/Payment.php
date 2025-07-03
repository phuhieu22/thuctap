<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property int $id
 * @property int $order_id
 * @property float $amount
 * @property Carbon $payment_date
 * @property string $status
 * @property string $payment_method
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Payment extends Model
{
	protected $table = 'payments';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'order_id' => 'int',
		'amount' => 'float',
		'payment_date' => 'datetime'
	];

	protected $fillable = [
		'order_id',
		'amount',
		'payment_date',
		'status',
		'payment_method'
	];
}
