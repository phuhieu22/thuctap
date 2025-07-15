<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
	use HasFactory;

	protected $table = 'orders';

	protected $casts = [
		'total_amount' => 'float',
		'user_id' => 'int',
	];

	protected $fillable = [
		'user_id',
		'status',
		'total_amount',
		'payment_method',
		'shipping_address',
		'phone',
		'email',
		'customer_name',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function orderItems(): HasMany
	{
		return $this->hasMany(OrderItem::class);
	}
}
