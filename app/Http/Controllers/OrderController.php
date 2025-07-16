<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function history()
    {
        $orders = Order::where('customer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('order.history', compact('orders'));
    }
}
