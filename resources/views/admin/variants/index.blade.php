@extends('admin.layouts.admin')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Danh sách biến thể Laptop</h4>
                    </div>
                    <a href="{{ route('admin.variants.create') }}" class="btn btn-primary btn-sm">+ Thêm biến thể</a>
                </div>

                <div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover table-centered">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên biến thể</th>
                                    <th>Giá</th>
                                    <th>Tồn kho</th>
                                    <th>Thông số</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($variants as $variant)
                                <tr>
                                    <td>{{ $variant->id }}</td>
                                    <td>{{ $variant->variant_name }}</td>
                                    <td>{{ number_format($variant->price) }} ₫</td>
                                    <td>{{ $variant->stock }}</td>
                                    <td>{{ $variant->specifications }}</td>
                                    <td>{{ $variant->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.variants.show', $variant->id) }}" class="btn btn-light btn-sm" title="Xem">
                                                <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                            </a>
                                            <a href="{{ route('admin.variants.edit', $variant->id) }}" class="btn btn-soft-primary btn-sm" title="Sửa">
                                                <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                            </a>
                                            <form action="{{ route('admin.variants.destroy', $variant->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-soft-danger btn-sm" title="Xóa">
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Chưa có biến thể nào.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer border-top">
                    {{ $variants->links() }} {{-- Phân trang --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
