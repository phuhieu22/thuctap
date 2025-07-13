<x-admin-layout>
    <x-slot:title>
        Quản lý Đơn hàng
    </x-slot:title>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Quản lý Đơn hàng</h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Danh sách Đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name ?? $order->customer_name ?? 'N/A' }}</td>
                                        <td>{{ number_format($order->total_amount, 0, ', ', '.') }} VNĐ</td>
                                        <td>
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
                                        </td>
                                        <td>{{ $order->payment_method ?? 'N/A' }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info me-2" title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            {{-- Nút chỉnh sửa/xóa nếu cần --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Không có đơn hàng nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 