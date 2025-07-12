<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\LaptopVariant;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function viewCart()
    {
        $userId = auth()->id();

        $cartItems = CartItem::with(['laptopVariant', 'laptopVariant.laptop.images'])->where('user_id', $userId)->get();


        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'laptop_variant_id' => 'required|exists:laptop_variants,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if (auth()->check()) {
            // 🔑 Đã đăng nhập → lưu DB
            $userId = auth()->id();

            $cartItem = CartItem::where('user_id', $userId)
                ->where('laptop_variant_id', $request->laptop_variant_id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id' => $userId,
                    'laptop_variant_id' => $request->laptop_variant_id,
                    'quantity' => $request->quantity
                ]);
            }
        } else {
            // 🔒 Chưa đăng nhập → lưu vào session
            $cart = session()->get('cart', []);

            if (isset($cart[$request->laptop_variant_id])) {
                $cart[$request->laptop_variant_id]['quantity'] += $request->quantity;
            } else {
                $cart[$request->laptop_variant_id] = [
                    'quantity' => $request->quantity
                ];
            }

            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }
    public function updateQuantity(Request $request, $id)
    {
        $cartItem = CartItem::with('laptopVariant.laptop')->findOrFail($id);

        if ($cartItem->user_id != auth()->id()) {
            abort(403);
        }

        $variant = $cartItem->laptopVariant;
        $laptop = $variant->laptop;

        if ($request->action === 'increase') {
            if ($cartItem->quantity < $variant->stock && $laptop->stock > 0) {
                $cartItem->quantity++;
                $cartItem->save();

                // Trừ stock của biến thể
                $variant->stock--;
                $variant->save();

                // Trừ stock của sản phẩm cha
                $laptop->stock--;
                $laptop->save();
            }
        } elseif ($request->action === 'decrease') {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $cartItem->save();

                // Cộng lại stock của biến thể
                $variant->stock++;
                $variant->save();

                // Cộng lại stock của sản phẩm cha
                $laptop->stock++;
                $laptop->save();
            }
        }

        return back();
    }


    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id != auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return back();
    }

    public function checkoutForm()
    {
        $user = auth()->user();
        $cartItems = CartItem::with('laptopVariant.laptop')
            ->where('user_id', $user->id)
            ->get();

        $total = $cartItems->sum(fn($item) => $item->laptopVariant->price * $item->quantity);

        return view('checkout.form', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'payment_method' => 'required|in:cash,credit_card,paypal,bank_transfer',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $cartItems = CartItem::with('laptopVariant')->where('user_id', $user->id)->get();

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Giỏ hàng của bạn đang trống!');
            }

            $totalAmount = $cartItems->sum(fn($item) => $item->laptopVariant->price * $item->quantity);

            $order = Order::create([
                'customer_id' => $user->id,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'laptop_id' => $item->laptopVariant->laptop_id,
                    'quantity' => $item->quantity,
                    'price' => $item->laptopVariant->price,
                ]);

                // Cập nhật lại stock
                $item->laptopVariant->decrement('stock', $item->quantity);
                $item->laptopVariant->laptop->decrement('stock', $item->quantity);
            }

            ShippingAddress::create([
                'customer_id' => $user->id,
                'order_id' => $order->id,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]);

            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => 'unpaid',
            ]);

            CartItem::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('laptops.index')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Đặt hàng thất bại. Vui lòng thử lại!');
        }
    }
}
