<x-admin-layout>
    <x-slot:title>
        Chi tiết Đơn hàng #{{ $order->id }}
    </x-slot:title>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Chi tiết Đơn hàng #{{ $order->id }}</h1>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách đơn hàng
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin Đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
                            <p><strong>Khách hàng:</strong> {{ $order->user->name ?? $order->customer_name ?? 'N/A' }} ({{ $order->user->email ?? $order->email ?? 'N/A' }})</p>
                            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ', ', '.') }} VNĐ</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Trạng thái:</strong> 
                                @php
                                    $statusClass = '';
                                    switch($order->status) {
                                        case 'pending': $statusClass = 'badge bg-warning'; break;
                                        case 'processing': $statusClass = 'badge bg-info'; break;
                                        case 'completed': $statusClass = 'badge bg-success'; break;
                                        case 'cancelled': $statusClass = 'badge bg-danger'; break;
                                        default: $statusClass = 'badge bg-secondary'; break;
                                    }
                                @endphp
                                <span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                            </p>
                            <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
                            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->shipping_address ?? 'N/A' }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $order->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Cập nhật trạng thái đơn hàng</h5>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="input-group">
                                    <select class="form-select" name="status" id="status">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sản phẩm trong Đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->laptop->name ?? 'N/A' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0, ', ', '.') }} VNĐ</td>
                                        <td>{{ number_format($item->quantity * $item->price, 0, ', ', '.') }} VNĐ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 