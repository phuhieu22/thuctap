@extends('admin.layouts.admin')

@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Chi tiết biến thể Laptop</h4>
                    <a href="{{ route('admin.variants.index') }}" class="btn btn-secondary btn-sm">← Quay lại</a>
                </div>

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4 text-dark">ID</dt>
                        <dd class="col-sm-8">{{ $variant->id }}</dd>

                        <dt class="col-sm-4 text-dark">Tên biến thể</dt>
                        <dd class="col-sm-8">{{ $variant->variant_name }}</dd>

                        <dt class="col-sm-4 text-dark">Giá</dt>
                        <dd class="col-sm-8">{{ number_format($variant->price) }} ₫</dd>

                        <dt class="col-sm-4 text-dark">Số lượng tồn</dt>
                        <dd class="col-sm-8">{{ $variant->stock }}</dd>

                        <dt class="col-sm-4 text-dark">Thông số kỹ thuật</dt>
                        <dd class="col-sm-8">{{ $variant->specifications ?: 'Không có' }}</dd>

                        <dt class="col-sm-4 text-dark">Ngày tạo</dt>
                        <dd class="col-sm-8">{{ $variant->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-4 text-dark">Cập nhật gần nhất</dt>
                        <dd class="col-sm-8">{{ $variant->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
