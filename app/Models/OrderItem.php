<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * 
 * @property int $id
 * @property int $order_id
 * @property int $laptop_id
 * @property int $quantity
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class OrderItem extends Model
{
	protected $table = 'order_items';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'order_id' => 'int',
		'laptop_id' => 'int',
		'quantity' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'order_id',
		'laptop_id',
		'quantity',
		'price'
	];
}
