@extends('layouts.app')

@section('title', 'Tất cả sản phẩm')

@section('content')
<div class="container py-5">
  <div class="row">
    {{-- Cột trái: danh sách sản phẩm --}}
    <div class="col-md-9">
      <div class="row">
        @forelse($laptops as $laptop)
        <div class="col-md-4 mb-4">
          <div class="product-card position-relative">
            <div class="image-holder">
              <img src="{{ asset($laptop->main_image) }}" alt="{{ $laptop->model }}" class="img-fluid">
            </div>
            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
              <h3 class="card-title text-uppercase">
                <a href="{{ route('products.show', $laptop->id) }}">{{ $laptop->model }}</a>
              </h3>
              <span class="item-price text-primary">{{ number_format($laptop->price) }} đ</span>
            </div>
          </div>
        </div>
        @empty
        <p>Không tìm thấy sản phẩm phù hợp.</p>
        @endforelse
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-center">
        {{ $laptops->appends(request()->query())->links() }}
      </div>
    </div>

    {{-- Cột phải: Bộ lọc --}}
    <div class="col-md-3">
      <form method="GET" action="{{ route('products.index') }}" class="p-3 border bg-light rounded">
        <h5 class="text-uppercase mb-3">Bộ lọc</h5>

        {{-- Tìm kiếm --}}
        <div class="mb-3">
          <label for="search" class="form-label">Tìm kiếm</label>
          <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}">
        </div>

        {{-- Danh mục --}}
        <div class="mb-3">
          <label for="category_id" class="form-label">Danh mục</label>
          <select name="category_id" id="category_id" class="form-select">
            <option value="">-- Tất cả --</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Giá --}}
        <div class="mb-3">
          <label class="form-label">Giá từ</label>
          <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Đến</label>
          <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}">
        </div>

        <button type="submit" class="btn btn-dark w-100">Lọc</button>
      </form>
    </div>
  </div>
</div>
@endsection
