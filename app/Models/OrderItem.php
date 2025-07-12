<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OrderItem extends Model
{
	use HasFactory; // 👉 thêm dòng này
	protected $table = 'order_items';
	public $incrementing = false;

	protected $fillable = [
		'order_id',
		'laptop_id',
		'quantity',
		'price'
	];
}
