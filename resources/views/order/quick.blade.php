@extends('layouts.app')
@section('title', 'Đặt hàng nhanh')

@section('content')
<div class="container py-4">
    <h2>🚀 Đặt hàng nhanh</h2>

    @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <form action="{{ route('order.quick.place') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="variant_id" class="form-label">Chọn sản phẩm</label>
            <select name="variant_id" id="variant_id" class="form-select" required>
                @foreach ($variants as $variant)
                    <option value="{{ $variant->id }}">
                        {{ $variant->laptop->model }} - {{ $variant->variant_name }} ({{ number_format($variant->price) }}đ - còn {{ $variant->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Số lượng</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
        </div>

        <h5>Thông tin giao hàng</h5>

        <div class="mb-2"><input type="text" name="address" class="form-control" placeholder="Địa chỉ" required></div>
        <div class="mb-2"><input type="text" name="city" class="form-control" placeholder="Thành phố" required></div>
        <div class="mb-2"><input type="text" name="postal_code" class="form-control" placeholder="Mã bưu chính" required></div>
        <div class="mb-2"><input type="text" name="country" class="form-control" placeholder="Quốc gia" required></div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
            <select name="payment_method" id="payment_method" class="form-select">
                <option value="cash">Tiền mặt</option>
                <option value="credit_card">Thẻ tín dụng</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Chuyển khoản</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">🛒 Xác nhận đặt hàng</button>
    </form>
</div>
@endsection
