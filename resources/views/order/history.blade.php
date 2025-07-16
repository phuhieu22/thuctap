@extends('layouts.app')
@section('title', 'Lịch sử đơn hàng')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📦 Lịch sử đặt hàng của bạn</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Phương thức</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($order->total_amount) }} đ</td>
                    <td>{{ ucfirst($order->payment_method) }}</td>
                    <td>
                        @switch($order->status)
                            @case('pending')
                                <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                @break
                            @case('processing')
                                <span class="badge bg-info">Đang xử lý</span>
                                @break
                            @case('completed')
                                <span class="badge bg-success">Hoàn tất</span>
                                @break
                            @case('cancelled')
                                <span class="badge bg-danger">Đã huỷ</span>
                                @break
                            @default
                                <span class="badge bg-secondary">{{ $order->status }}</span>
                        @endswitch
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    @endif
</div>
@endsection
