<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Payment extends Model
{
	use HasFactory; // 👉 thêm dòng này
	protected $table = 'payments';
	public $incrementing = false;


	protected $fillable = [
		'order_id',
		'amount',
		'payment_date',
		'status',
		'payment_method'
	];

}
