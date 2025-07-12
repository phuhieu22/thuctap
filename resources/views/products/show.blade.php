@extends('layouts.app')

@section('title', $laptop->model)

@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ $laptop->images->first()->url ?? '/images/default.png' }}" class="img-fluid rounded" alt="{{ $laptop->model }}">
    </div>
    <div class="col-md-6">
        <h2>{{ $laptop->model }}</h2>
        <p class="text-danger fs-4 fw-bold">{{ number_format($laptop->price) }} đ</p>
        <p><strong>Hãng:</strong> {{ $laptop->brand->name ?? 'Không rõ' }}</p>
        <p><strong>Danh mục:</strong> {{ $laptop->category->name ?? 'Không rõ' }}</p>
        <p><strong>Mô tả:</strong></p>
        <p>{{ $laptop->description }}</p>
        <button class="btn btn-primary mt-3">Thêm vào giỏ</button>
    </div>
</div>
@endsection
