<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
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
