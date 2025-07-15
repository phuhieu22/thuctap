@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

{{-- Billboard Slider --}}
<section id="billboard" class="position-relative overflow-hidden bg-light-blue">
  <div class="swiper main-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-md-6">
              <div class="banner-content">
                <h1 class="display-2 text-uppercase text-dark pb-5">Your Products Are Great.</h1>
                <a href="{{ route('products.index') }}" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
              </div>
            </div>
            <div class="col-md-5">
              <div class="image-holder">
                <img src="{{ asset('assets/images/banner-image.png') }}" alt="banner">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Slide 2 (Optional) -->
    </div>
  </div>
  <div class="swiper-icon swiper-arrow swiper-arrow-prev">
    <svg class="chevron-left"><use xlink:href="#chevron-left" /></svg>
  </div>
  <div class="swiper-icon swiper-arrow swiper-arrow-next">
    <svg class="chevron-right"><use xlink:href="#chevron-right" /></svg>
  </div>
</section>

{{-- Services --}}
<section id="company-services" class="padding-large">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 pb-3">
        <div class="icon-box d-flex">
          <div class="icon-box-icon pe-3 pb-3">
            <svg class="cart-outline"><use xlink:href="#cart-outline" /></svg>
          </div>
          <div class="icon-box-content">
            <h3 class="card-title text-uppercase text-dark">Free delivery</h3>
            <p>Consectetur adipi elit lorem ipsum dolor sit amet.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 pb-3">
        <div class="icon-box d-flex">
          <div class="icon-box-icon pe-3 pb-3">
            <svg class="quality"><use xlink:href="#quality" /></svg>
          </div>
          <div class="icon-box-content">
            <h3 class="card-title text-uppercase text-dark">Quality guarantee</h3>
            <p>Dolor sit amet lorem ipsum consectetur adipi elit.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 pb-3">
        <div class="icon-box d-flex">
          <div class="icon-box-icon pe-3 pb-3">
            <svg class="price-tag"><use xlink:href="#price-tag" /></svg>
          </div>
          <div class="icon-box-content">
            <h3 class="card-title text-uppercase text-dark">Daily offers</h3>
            <p>Amet consectetur adipi elit lorem ipsum dolor sit.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 pb-3">
        <div class="icon-box d-flex">
          <div class="icon-box-icon pe-3 pb-3">
            <svg class="shield-plus"><use xlink:href="#shield-plus" /></svg>
          </div>
          <div class="icon-box-content">
            <h3 class="card-title text-uppercase text-dark">100% secure payment</h3>
            <p>Rem lorem ipsum dolor sit amet, consectetur elit.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Sản phẩm theo danh mục --}}
@foreach($categories as $category)
<section class="product-store padding-large">
  <div class="container">
    <div class="display-header d-flex justify-content-between pb-3">
      <h2 class="display-7 text-dark text-uppercase">{{ $category->name }}</h2>
      <div class="btn-right">
        <a href="{{ route('products.index', $category->id) }}" class="btn btn-medium btn-normal text-uppercase">Xem tất cả</a>
      </div>
    </div>
    <div class="row">
      @forelse($category->laptops->take(4) as $laptop)
        <div class="col-md-3 mb-4">
          <div class="product-card position-relative">
            <div class="image-holder">
              <img src="{{ asset($laptop->main_image) }}" alt="{{ $laptop->model }}" class="img-fluid">
            </div>
            <div class="cart-concern position-absolute">
              <div class="cart-button d-flex">
                <a href="#" class="btn btn-medium btn-black">
                  Add to Cart
                  <svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg>
                </a>
              </div>
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
        <p class="text-muted">Không có sản phẩm nào.</p>
      @endforelse
    </div>
  </div>
</section>
@endforeach

@endsection
