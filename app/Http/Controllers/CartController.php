<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;

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


}
