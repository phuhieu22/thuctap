<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán | Laptop Shop</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="mb-4">🛒 Thanh toán</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($cartItems->isEmpty())
            <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
            <a href="{{ route('laptops.index') }}" class="btn btn-primary">Tiếp tục mua hàng</a>
        @else
            <form method="POST" action="{{ route('checkout.place') }}">
                @csrf

                <!-- Sản phẩm -->
                <h4>🧾 Đơn hàng</h4>
                <ul class="list-group mb-4">
                    @foreach ($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->laptopVariant->laptop->model }}</strong><br>
                                Biến thể: {{ $item->laptopVariant->variant_name }}<br>
                                Số lượng: {{ $item->quantity }}
                            </div>
                            <span>{{ number_format($item->laptopVariant->price * $item->quantity, 0, ',', '.') }}đ</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Tổng cộng:</strong>
                        <strong>{{ number_format($total, 0, ',', '.') }}đ</strong>
                    </li>
                </ul>

                <!-- Địa chỉ giao hàng -->
                <h4>📦 Thông tin giao hàng</h4>
                <div class="mb-3">
                    <label>Địa chỉ chi tiết</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Thành phố</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Mã bưu điện</label>
                        <input type="text" name="postal_code" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Quốc gia</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>
                </div>

                <!-- Thanh toán -->
                <h4>💳 Phương thức thanh toán</h4>
                <div class="mb-4">
                    <select name="payment_method" class="form-select" required>
                        <option value="">-- Chọn phương thức --</option>
                        <option value="cash">Thanh toán khi nhận hàng</option>
                        <option value="credit_card">Thẻ tín dụng</option>
                        <option value="paypal">Paypal</option>
                        <option value="bank_transfer">Chuyển khoản</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100">✅ Đặt hàng</button>
            </form>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
