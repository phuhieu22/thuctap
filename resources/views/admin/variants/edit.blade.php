@extends('admin.layouts.admin')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chỉnh sửa biến thể Laptop</h4>
                </div>
                <form action="{{ route('admin.variants.update', $variant->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Tên biến thể -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="variant_name" class="form-label text-dark">Tên biến thể</label>
                                    <input type="text" name="variant_name" id="variant_name" class="form-control" value="{{ old('variant_name', $variant->variant_name) }}" required>
                                </div>
                            </div>

                            <!-- Giá -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label text-dark">Giá (VNĐ)</label>
                                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $variant->price) }}" required>
                                </div>
                            </div>

                            <!-- Tồn kho -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label text-dark">Số lượng tồn</label>
                                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $variant->stock) }}" required>
                                </div>
                            </div>

                            <!-- Thông số kỹ thuật -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="specifications" class="form-label text-dark">Thông số kỹ thuật</label>
                                    <textarea name="specifications" id="specifications" class="form-control" rows="4" placeholder="Nhập thông số...">{{ old('specifications', $variant->specifications) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border-top">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.variants.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
