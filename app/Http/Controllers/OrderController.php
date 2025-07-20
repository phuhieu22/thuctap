<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\LaptopVariant;
use App\Models\OrderItem;
use App\Models\ShippingAddress;

class OrderController extends Controller
{

    public function history()
    {
        $orders = Order::where('customer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('order.history', compact('orders'));
    }
    public function placeQuickOrder(Request $request)
    {
        // 1. Validate đầu vào
        $v = $request->validate([
            'variant_id'     => 'required|integer',
            'quantity'       => 'required|integer|min:1',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'postal_code'    => 'required|string',
            'country'        => 'required|string',
            'payment_method' => 'required|in:cash,vnpay',
        ]);

        // 2. Lấy biến thể & tính total_amount
        $variant = LaptopVariant::findOrFail($v['variant_id']);
        $total   = $variant->price * $v['quantity'];

        // 3. Tạo order (chỉ những cột hiện có trong table `orders`)
        $order = Order::create([
            'customer_id'    => auth()->id(),
            'order_date'     => now(),
            'total_amount'   => $total,
            'payment_method' => $v['payment_method'],
            'status'         => 'pending',
        ]);

        // 4. Luôn split dữ liệu sang bảng phụ trước khi redirect
        OrderItem::create([
            'order_id'   => $order->id,
            'laptop_id'  => $v['variant_id'],    // cột trong order_items là laptop_id
            'quantity'   => $v['quantity'],
            'price'      => $variant->price,     // giữ lại giá từng item
        ]);

        ShippingAddress::create([
            'customer_id' => auth()->id(),
            'order_id'    => $order->id,
            'address'     => $v['address'],
            'city'        => $v['city'],
            'postal_code' => $v['postal_code'],
            'country'     => $v['country'],
        ]);

        // 5. Redirect theo phương thức thanh toán
        if ($v['payment_method'] === 'vnpay') {
            return redirect()->route('vnpay.create', ['order' => $order->id]);
        }

        return redirect()
            ->route('order.quick.form')
            ->with('success', 'Đặt hàng thành công!');
    }



    public function quickOrderForm()
    {
        // 1. Lấy danh sách biến thể còn hàng
        $variants = LaptopVariant::where('stock', '>', 0)->get();

        // 2. Lịch sử đơn hàng của user hiện tại
        $orders = Order::where('customer_id', auth()->id())
                       ->orderByDesc('created_at')
                       ->get();

        return view('quick', compact('variants', 'orders'));
    }

}
