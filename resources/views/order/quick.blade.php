@extends('layouts.app')
@section('title', 'Đặt hàng nhanh')

@section('content')
<div class="container py-4">
  <h2>🚀 Đặt hàng nhanh</h2>

  {{-- Flash --}}
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Form đặt hàng --}}
  <form action="{{ route('order.quick.place') }}" method="POST">
    @csrf

    {{-- Sản phẩm --}}
    <div class="mb-3">
      <label class="form-label">Chọn sản phẩm</label>
      <select name="variant_id" class="form-select" required>
        @foreach($variants as $v)
          <option value="{{ $v->id }}">
            {{ optional($v->laptop)->model ?? 'N/A' }}
            – {{ $v->variant_name }}
            ({{ number_format($v->price,0,',','.') }}₫ – còn {{ $v->stock }})
          </option>
        @endforeach
      </select>
    </div>

    {{-- Số lượng --}}
    <div class="mb-3">
      <label class="form-label">Số lượng</label>
      <input type="number" name="quantity" class="form-control" value="1" min="1" required>
    </div>

    {{-- Thông tin giao hàng --}}
    <h5>📝 Thông tin giao hàng</h5>
    <div class="mb-2"><input type="text" name="address" class="form-control" placeholder="Địa chỉ" required></div>
    <div class="mb-2"><input type="text" name="city" class="form-control" placeholder="Thành phố" required></div>
    <div class="mb-2"><input type="text" name="postal_code" class="form-control" placeholder="Mã bưu chính" required></div>
    <div class="mb-2"><input type="text" name="country" class="form-control" placeholder="Quốc gia" required></div>

    {{-- Phương thức thanh toán --}}
    <div class="mb-4">
      <label class="form-label">Phương thức thanh toán</label>
      <select name="payment_method" class="form-select" required>
        <option value="cash">Tiền mặt</option>
        <option value="vnpay">VNPay (QR)</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary w-100">🛒 Xác nhận đặt hàng</button>
  </form>

  {{-- QR VNPay (nếu có) --}}
  @isset($qrUrl)
    <div class="card border-success p-4 mt-5 text-center">
      <h5>Quét QR để thanh toán VNPay</h5>
      <p><strong>Số tiền: {{ number_format($order->total_amount,0,',','.') }}₫</strong></p>
      <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{ urlencode($qrUrl) }}"
           alt="QR Code" class="mx-auto" style="max-width:300px;">
      <p>Hoặc <a href="{{ $qrUrl }}" target="_blank">click vào đây</a> để thanh toán.</p>
    </div>
  @endisset

  {{-- Lịch sử đơn hàng --}}
  <hr class="my-5">
  <h4>Lịch sử đơn hàng</h4>
  {{-- @if($orders->isEmpty())
    <p>Chưa có đơn hàng nào.</p>
  @else
    <table class="table">
      <thead><tr>
        <th>#</th><th>Ngày</th><th>Tổng</th><th>PT thanh toán</th><th>Trạng thái</th><th>Hành động</th>
      </tr></thead>
      <tbody>
      @foreach($orders as $o)
        <tr>
          <td>{{ $o->id }}</td>
          <td>{{ $o->created_at->format('d/m/Y H:i') }}</td>
          <td>{{ number_format($o->total_amount,0,',','.') }}₫</td>
          <td>{{ strtoupper($o->payment_method) }}</td>
          <td>
            @if($o->status==='paid')
              <span class="badge bg-success">Đã thanh toán</span>
            @else
              <span class="badge bg-warning">Chưa thanh toán</span>
            @endif
          </td>
          <td>
            @if($o->status!=='paid' && $o->payment_method==='vnpay')
              <a href="{{ route('vnpay.create', $o->id) }}"
                 class="btn btn-sm btn-success">Thanh toán VNPay</a>
            @else
              —
            @endif
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @endif --}}

</div>
@endsection

<script>
    document.getElementById('pay-btn').onclick = function() {
    let method = document.getElementById('payment_method').value;
    if (method === 'vnpay') {
        // Có thể redirect, hoặc gọi API, hoặc show popup QR, tuỳ bạn
        window.location.href = `/vnpay/create/${orderId}?payment_method=vnpay`;
    } else {
        // Xử lý các phương thức khác
        alert('Bạn chọn thanh toán tiền mặt!');
    }
}
</script>
