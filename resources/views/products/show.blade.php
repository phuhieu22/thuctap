@extends('layouts.app')

@section('title', $laptop->model)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <img src="{{ $laptop->images->first()->url ?? '/images/default.png' }}" class="img-fluid rounded border shadow" alt="{{ $laptop->model }}">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">{{ $laptop->model }}</h2>
            <p class="text-danger fs-4 fw-bold">{{ number_format($laptop->price) }} đ</p>
            <p><strong>Hãng:</strong> {{ $laptop->brand->name ?? 'Không rõ' }}</p>
            <p><strong>Danh mục:</strong> {{ $laptop->category->name ?? 'Không rõ' }}</p>
            <p><strong>Mô tả:</strong></p>
            <p class="text-muted">{{ $laptop->description }}</p>
            <button class="btn btn-primary mt-3">Thêm vào giỏ</button>
        </div>
    </div>

    <hr class="my-4">

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h4 class="mb-3">Đánh giá và bình luận</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @auth
            <form action="{{ route('reviews.store') }}" method="POST" class="mb-4 p-3 border rounded shadow-sm bg-light">
                @csrf
                <input type="hidden" name="laptop_id" value="{{ $laptop->id }}">

                <div class="mb-3">
                    <label for="rating" class="form-label">Đánh giá (1-5 sao):</label>
                    <select name="rating" id="rating" class="form-select" required>
                        <option value="">Chọn sao</option>
                        @for($i=5; $i>=1; $i--)
                            <option value="{{ $i }}">{{ $i }} sao</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Bình luận:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Nhập nhận xét của bạn..."></textarea>
                </div>

                <button type="submit" class="btn btn-success">Gửi đánh giá</button>
            </form>
            @else
                <p class="text-center">Bạn cần <a href="{{ route('login') }}">đăng nhập</a> để gửi đánh giá.</p>
            @endauth

            <hr class="my-4">

            <h5 class="mb-3">Danh sách đánh giá</h5>

            @php
                $reviews = $laptop->reviews()->with('customer')->latest()->get();
            @endphp

            @forelse($reviews as $review)
                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>{{ $review->customer->name ?? 'Khách hàng' }}</strong>
                        <span class="text-warning">⭐ {{ $review->rating }}/5</span>
                    </div>
                    <p class="mb-1">{{ $review->comment }}</p>
                    <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @empty
                <p class="text-muted">Chưa có đánh giá nào.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
