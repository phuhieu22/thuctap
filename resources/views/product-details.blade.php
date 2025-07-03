<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $laptop->brand->name ?? 'Product' }} {{ $laptop->model ?? 'Details' }} - eStore Bootstrap Template</title>
  <meta name="description" content="{{ $laptop->description ?? 'Product details' }}">
  <meta name="keywords" content="{{ $laptop->brand->name ?? 'Product' }}, {{ $laptop->model ?? 'Details' }}, {{ $laptop->category->name ?? 'Category' }}">

  <!-- Bootstrap CSS từ CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
  
  <style>
    .product-details-page {
      font-family: 'Roboto', sans-serif;
    }
    
    .header {
      background: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .top-bar {
      background: #f8f9fa;
      font-size: 14px;
    }
    
    .sitename {
      color: #007bff;
      font-weight: bold;
    }
    
    .product-images .main-image {
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .thumbnail-item {
      cursor: pointer;
      border: 2px solid transparent;
      border-radius: 4px;
      overflow: hidden;
    }
    
    .thumbnail-item.active {
      border-color: #007bff;
    }
    
    .product-category {
      background: #e3f2fd;
      color: #1976d2;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
    }
    
    .product-rating {
      color: #ffc107;
    }
    
    .current-price {
      font-size: 2rem;
      font-weight: bold;
      color: #007bff;
    }
    
    .original-price {
      text-decoration: line-through;
      color: #6c757d;
    }
    
    .discount-badge {
      background: #dc3545;
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
    }
    
    .color-option {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 3px solid transparent;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 8px;
    }
    
    .color-option.active {
      border-color: #333;
    }
    
    .color-option i {
      color: white;
      display: none;
    }
    
    .color-option.active i {
      display: block;
    }
    
    .size-option {
      border: 1px solid #dee2e6;
      padding: 8px 16px;
      margin-right: 8px;
      cursor: pointer;
      border-radius: 4px;
    }
    
    .size-option.active {
      background: #333;
      color: white;
      border-color: #333;
    }
    
    .quantity-selector {
      display: flex;
      align-items: center;
    }
    
    .quantity-btn {
      border: 1px solid #dee2e6;
      background: white;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .quantity-input {
      width: 80px;
      text-align: center;
      border: 1px solid #dee2e6;
      height: 40px;
      transition: all 0.2s ease;
    }
    
    .product-actions .btn {
      padding: 12px 24px;
      font-weight: 500;
    }
    
    .additional-info .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
      font-size: 14px;
      color: #6c757d;
    }
    
    .additional-info .info-item i {
      margin-right: 8px;
      color: #28a745;
    }
    
    .nav-tabs .nav-link {
      border: none;
      color: #6c757d;
      font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
      color: #007bff;
      border-bottom: 2px solid #007bff;
    }
    
    .specs-table .specs-row {
      display: flex;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px solid #f1f1f1;
    }
    
    .specs-label {
      font-weight: 500;
      color: #333;
    }
    
    .specs-value {
      color: #6c757d;
    }
    
    .review-item {
      border: 1px solid #f1f1f1;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
    }
    
    .reviewer-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
    
    .page-title {
      background: #f8f9fa;
      padding: 40px 0;
    }
    
    .breadcrumbs ol {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
    }
    
    .breadcrumbs li {
      margin-right: 8px;
    }
    
    .breadcrumbs li:after {
      content: '/';
      margin-left: 8px;
      color: #6c757d;
    }
    
    .breadcrumbs li:last-child:after {
      display: none;
    }
    
    .breadcrumbs a {
      color: #007bff;
      text-decoration: none;
    }
    
    .breadcrumbs .current {
      color: #6c757d;
    }

    /* Quantity Controls Styling */
    .quantity-btn:disabled {
        opacity: 0.3 !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
        background-color: #f8f9fa !important;
        border-color: #e9ecef !important;
        color: #6c757d !important;
    }

    .quantity-btn:not(:disabled):hover {
        background-color: #f8f9fa;
        border-color: #007bff;
        color: #007bff;
    }

    .quantity-input:disabled {
        opacity: 0.5 !important;
        cursor: not-allowed !important;
        background-color: #f8f9fa !important;
        border-color: #e9ecef !important;
        color: #6c757d !important;
    }

    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Disabled state for entire quantity selector */
    .quantity-selector.disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    .quantity-selector.disabled .quantity-btn,
    .quantity-selector.disabled .quantity-input {
        cursor: not-allowed;
        background-color: #f8f9fa;
        border-color: #e9ecef;
        color: #6c757d;
    }
  </style>
</head>

<body class="product-details-page">
  <header id="header" class="header">
    <div class="top-bar py-2">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 d-none d-lg-flex">
            <div class="top-bar-item">
              <i class="bi bi-telephone-fill me-2"></i>
              <span>Need help? Call us: </span>
              <a href="tel:+1234567890">+1 (234) 567-890</a>
            </div>
          </div>

          <div class="col-lg-4 col-md-12 text-center">
            <div class="text-center">
              🚚 Free shipping on orders over $50
            </div>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
            <div class="d-flex justify-content-end">
              <div class="me-3">
                <i class="bi bi-translate me-2"></i>EN
              </div>
              <div>
                <i class="bi bi-currency-dollar me-2"></i>USD
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main-header">
      <div class="container">
        <div class="d-flex py-3 align-items-center justify-content-between">
          <a href="{{ route('laptops.index') }}" class="logo d-flex align-items-center">
            <h1 class="sitename mb-0">eStore</h1>
          </a>

          <form class="search-form d-none d-md-flex flex-1 mx-4">
            <div class="input-group" style="max-width: 400px;">
              <input type="text" class="form-control" placeholder="Search for products">
              <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>

          <div class="header-actions d-flex align-items-center">
            <button class="btn btn-link me-2">
              <i class="bi bi-person"></i>
            </button>
            <button class="btn btn-link me-2 position-relative">
              <i class="bi bi-heart"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </button>
            <button class="btn btn-link position-relative">
              <i class="bi bi-cart3"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('laptops.index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('laptops.index') }}">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Product Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="main">
    <div class="page-title">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{ $laptop->brand->name ?? 'Product' }} {{ $laptop->model ?? 'Details' }}</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('laptops.index') }}">Home</a></li>
            <li><a href="{{ route('laptops.index') }}">{{ $laptop->category->name ?? 'Category' }}</a></li>
            <li class="current">{{ $laptop->model ?? 'Product Details' }}</li>
          </ol>
        </nav>
      </div>
    </div>

    <section id="product-details" class="product-details py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="product-images">
              <div class="main-image-container mb-3">
                @if($laptop->images && $laptop->images->count() > 0)
                  <img src="{{ $laptop->images->first()->url }}" alt="{{ $laptop->model }}" class="img-fluid main-image w-100" id="main-product-image" style="height: 400px; object-fit: cover;">
                @else
                  <img src="https://via.placeholder.com/600x400?text=No+Image" alt="Product Image" class="img-fluid main-image w-100" id="main-product-image" style="height: 400px; object-fit: cover;">
                @endif
              </div>

              <div class="product-thumbnails">
                <div class="d-flex gap-2">
                  @if($laptop->images && $laptop->images->count() > 0)
                    @foreach($laptop->images as $index => $image)
                    <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" data-image="{{ $image->url }}" style="width: 80px; height: 80px;">
                      <img src="{{ $image->url }}" alt="Product Thumbnail {{ $index + 1 }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                    </div>
                    @endforeach
                  @else
                    <div class="thumbnail-item active" data-image="https://via.placeholder.com/600x400?text=No+Image" style="width: 80px; height: 80px;">
                      <img src="https://via.placeholder.com/80x80?text=1" alt="Product Thumbnail" class="img-fluid w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="thumbnail-item" data-image="https://via.placeholder.com/600x400?text=Image+2" style="width: 80px; height: 80px;">
                      <img src="https://via.placeholder.com/80x80?text=2" alt="Product Thumbnail" class="img-fluid w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="thumbnail-item" data-image="https://via.placeholder.com/600x400?text=Image+3" style="width: 80px; height: 80px;">
                      <img src="https://via.placeholder.com/80x80?text=3" alt="Product Thumbnail" class="img-fluid w-100 h-100" style="object-fit: cover;">
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="product-info">
              <div class="product-meta mb-2 d-flex align-items-center gap-3">
                <span class="product-category">{{ $laptop->category->name ?? 'Laptops' }}</span>
                <div class="product-rating d-flex align-items-center">
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= 4)
                      <i class="bi bi-star-fill"></i>
                    @elseif($i == 5)
                      <i class="bi bi-star-half"></i>
                    @else
                      <i class="bi bi-star"></i>
                    @endif
                  @endfor
                  <span class="rating-count ms-2">(42)</span>
                </div>
              </div>

              <h1 class="product-title mb-3">{{ $laptop->brand->name ?? 'Brand' }} {{ $laptop->model ?? 'Wireless Noise Cancelling Headphones' }}</h1>

              <div class="product-price-container mb-4 d-flex align-items-center gap-3">
                <span class="current-price">${{ number_format($laptop->price ?? 249.99, 2) }}</span>
                @if($laptop->variants && $laptop->variants->where('price', '>', $laptop->price)->count() > 0)
                  @php
                    $maxPrice = $laptop->variants->max('price');
                    $discount = round((($maxPrice - $laptop->price) / $maxPrice) * 100);
                  @endphp
                  <span class="original-price">${{ number_format($maxPrice, 2) }}</span>
                  <span class="discount-badge">-{{ $discount }}%</span>
                @else
                  <span class="original-price">$299.99</span>
                  <span class="discount-badge">-17%</span>
                @endif
              </div>

              <div class="product-short-description mb-4">
                <p>{{ $laptop->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at lacus congue, suscipit elit nec, tincidunt orci. Phasellus egestas nisi vitae lectus imperdiet venenatis.' }}</p>
              </div>

              <div class="product-availability mb-4 d-flex align-items-center">
                @if(($laptop->stock ?? 0) > 0)
                  <i class="bi bi-check-circle-fill text-success me-2"></i>
                  <span>In Stock</span>
                  <span class="stock-count ms-2">({{ $laptop->stock ?? 24 }} items left)</span>
                @else
                  <i class="bi bi-x-circle-fill text-danger me-2"></i>
                  <span>Out of Stock</span>
                  <span class="stock-count ms-2">(0 items left)</span>
                @endif
              </div>

              <!-- Variants Options -->
              @if($laptop->variants && $laptop->variants->count() > 0)
              <div class="product-colors mb-4">
                <h6 class="option-title mb-3">Variants:</h6>
                <div class="color-options d-flex">
                  @foreach($laptop->variants->take(4) as $index => $variant)
                  <div class="color-option {{ $index === 0 ? 'active' : '' }}" data-variant-id="{{ $variant->id }}" data-price="{{ $variant->price }}" data-stock="{{ $variant->stock }}">
                    <i class="bi bi-check"></i>
                  </div>
                  @endforeach
                </div>
                <span class="selected-option mt-2 d-block">{{ $laptop->variants->first()->variant_name ?? 'Base Model' }}</span>
              </div>
              @else
              <div class="product-colors mb-4">
                <h6 class="option-title mb-3">Color:</h6>
                <div class="color-options d-flex">
                  <div class="color-option active" data-color="Black" style="background-color: #222;">
                    <i class="bi bi-check"></i>
                  </div>
                  <div class="color-option" data-color="Silver" style="background-color: #C0C0C0;">
                    <i class="bi bi-check"></i>
                  </div>
                  <div class="color-option" data-color="Blue" style="background-color: #1E3A8A;">
                    <i class="bi bi-check"></i>
                  </div>
                  <div class="color-option" data-color="Rose Gold" style="background-color: #B76E79;">
                    <i class="bi bi-check"></i>
                  </div>
                </div>
                <span class="selected-option mt-2 d-block">Black</span>
              </div>
              @endif

              <!-- Size Options -->
              <div class="product-sizes mb-4">
                <h6 class="option-title mb-3">Size:</h6>
                <div class="size-options d-flex">
                  <div class="size-option" data-size="S">S</div>
                  <div class="size-option active" data-size="M">M</div>
                  <div class="size-option" data-size="L">L</div>
                </div>
                <span class="selected-option mt-2 d-block">M</span>
              </div>

              <!-- Quantity Selector -->
              <div class="product-quantity mb-4">
                <h6 class="option-title mb-3">Quantity:</h6>
                <div class="quantity-selector" id="quantity-selector">
                  <button class="quantity-btn decrease" id="decrease-btn">
                    <i class="bi bi-dash"></i>
                  </button>
                  <input type="number" class="quantity-input" id="quantity-input" value="1" min="1" max="{{ $laptop->stock ?? 24 }}" readonly>
                  <button class="quantity-btn increase" id="increase-btn">
                    <i class="bi bi-plus"></i>
                  </button>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="product-actions mb-4 d-flex gap-2">
                <button class="btn btn-primary flex-fill" {{ ($laptop->stock ?? 0) <= 0 ? 'disabled' : '' }}>
                  <i class="bi bi-cart-plus me-2"></i> Add to Cart
                </button>
                <button class="btn btn-outline-primary flex-fill" {{ ($laptop->stock ?? 0) <= 0 ? 'disabled' : '' }}>
                  <i class="bi bi-lightning-fill me-2"></i> Buy Now
                </button>
                <button class="btn btn-outline-secondary">
                  <i class="bi bi-heart"></i>
                </button>
              </div>

              <!-- Additional Info -->
              <div class="additional-info">
                <div class="info-item">
                  <i class="bi bi-truck"></i>
                  <span>Free shipping on orders over $50</span>
                </div>
                <div class="info-item">
                  <i class="bi bi-arrow-repeat"></i>
                  <span>30-day return policy</span>
                </div>
                <div class="info-item">
                  <i class="bi bi-shield-check"></i>
                  <span>2-year warranty</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-12">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab">Specifications</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews (42)</button>
              </li>
            </ul>

            <div class="tab-content mt-4" id="productTabsContent">
              <!-- Description Tab -->
              <div class="tab-pane fade show active" id="description" role="tabpanel">
                <div class="product-description">
                  <h4>Product Overview</h4>
                  <p>{{ $laptop->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at lacus congue, suscipit elit nec, tincidunt orci. Phasellus egestas nisi vitae lectus imperdiet venenatis. Suspendisse vulputate quam diam, et consectetur augue condimentum in. Aenean dapibus urna eget nisi pharetra, in iaculis nulla blandit. Praesent at consectetur sem, sed sollicitudin nibh. Ut interdum risus ac nulla placerat aliquet.' }}</p>

                  <h4>Key Features</h4>
                  <ul>
                    <li><strong>Brand:</strong> {{ $laptop->brand->name ?? 'Premium Brand' }}</li>
                    <li><strong>Model:</strong> {{ $laptop->model ?? 'Latest Model' }}</li>
                    <li><strong>Category:</strong> {{ $laptop->category->name ?? 'High-Performance Category' }}</li>
                    <li><strong>Price:</strong> ${{ number_format($laptop->price ?? 249.99, 2) }}</li>
                    @if($laptop->variants && $laptop->variants->count() > 0)
                      <li><strong>Available Variants:</strong> {{ $laptop->variants->count() }} options</li>
                    @endif
                  </ul>

                  <h4>What's in the Box</h4>
                  <ul>
                    <li>{{ $laptop->brand->name ?? 'Premium' }} {{ $laptop->model ?? 'Wireless Headphones' }}</li>
                    <li>Carrying Case</li>
                    <li>USB-C Charging Cable</li>
                    <li>3.5mm Audio Cable</li>
                    <li>User Manual</li>
                  </ul>
                </div>
              </div>

              <!-- Specifications Tab -->
              <div class="tab-pane fade" id="specifications" role="tabpanel">
                <div class="product-specifications">
                  <div class="specs-group">
                    <h4>Basic Information</h4>
                    <div class="specs-table">
                      <div class="specs-row">
                        <div class="specs-label">Brand</div>
                        <div class="specs-value">{{ $laptop->brand->name ?? 'Premium Brand' }}</div>
                      </div>
                      <div class="specs-row">
                        <div class="specs-label">Model</div>
                        <div class="specs-value">{{ $laptop->model ?? 'Latest Model' }}</div>
                      </div>
                      <div class="specs-row">
                        <div class="specs-label">Category</div>
                        <div class="specs-value">{{ $laptop->category->name ?? 'Electronics' }}</div>
                      </div>
                      <div class="specs-row">
                        <div class="specs-label">Price</div>
                        <div class="specs-value">${{ number_format($laptop->price ?? 249.99, 2) }}</div>
                      </div>
                      <div class="specs-row">
                        <div class="specs-label">Stock</div>
                        <div class="specs-value">{{ $laptop->stock ?? 24 }} units</div>
                      </div>
                      <div class="specs-row">
                        <div class="specs-label">Images</div>
                        <div class="specs-value">{{ $laptop->images->count() ?? 5 }} images</div>
                      </div>
                    </div>
                  </div>

                  @if($laptop->variants && $laptop->variants->count() > 0)
                  <div class="specs-group mt-4">
                    <h4>Available Variants</h4>
                    <div class="specs-table">
                      @foreach($laptop->variants as $variant)
                      <div class="specs-row">
                        <div class="specs-label">{{ $variant->variant_name }}</div>
                        <div class="specs-value">
                          ${{ number_format($variant->price, 2) }} - {{ $variant->stock }} in stock
                          @if($variant->specifications)
                            <br><small>{{ $variant->specifications }}</small>
                          @endif
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  @endif
                </div>
              </div>

              <!-- Reviews Tab -->
              <div class="tab-pane fade" id="reviews" role="tabpanel">
                <div class="product-reviews">
                  <div class="reviews-summary mb-4">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="overall-rating text-center">
                          <div class="rating-number display-4 fw-bold">4.5</div>
                          <div class="rating-stars text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                          </div>
                          <div class="rating-count">Based on 42 reviews</div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="rating-breakdown">
                          @foreach([5,4,3,2,1] as $stars)
                          <div class="d-flex align-items-center mb-2">
                            <span class="me-2" style="width: 60px;">{{ $stars }} stars</span>
                            <div class="progress flex-fill me-2" style="height: 8px;">
                              <div class="progress-bar bg-warning"></div>
                            </div>
                            <span style="width: 30px;">{{ [27,10,3,1,1][$loop->index] }}</span>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="review-form-container mb-5">
                    <h4>Write a Review</h4>
                    <form class="review-form">
                      <div class="mb-3">
                        <label class="form-label">Your Rating</label>
                        <div class="star-rating">
                          @for($i = 5; $i >= 1; $i--)
                          <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                          <label for="star{{ $i }}" title="{{ $i }} stars" class="text-warning me-1" style="cursor: pointer;">
                            <i class="bi bi-star-fill"></i>
                          </label>
                          @endfor
                        </div>
                      </div>

                      <div class="row g-3 mb-3">
                        <div class="col-md-6">
                          <label for="review-name" class="form-label">Your Name</label>
                          <input type="text" class="form-control" id="review-name" required>
                        </div>
                        <div class="col-md-6">
                          <label for="review-email" class="form-label">Your Email</label>
                          <input type="email" class="form-control" id="review-email" required>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="review-title" class="form-label">Review Title</label>
                        <input type="text" class="form-control" id="review-title" required>
                      </div>

                      <div class="mb-4">
                        <label for="review-content" class="form-label">Your Review</label>
                        <textarea class="form-control" id="review-content" rows="4" required></textarea>
                        <div class="form-text">Tell others what you think about this product. Be honest and helpful!</div>
                      </div>

                      <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                  </div>

                  <div class="reviews-list">
                    <h4>Customer Reviews</h4>
                    
                    @php
                    $reviews = [
                      ['name' => 'John Doe', 'date' => '03/15/2024', 'rating' => 5, 'title' => 'Exceptional quality from ' . ($laptop->brand->name ?? 'this brand'), 'content' => 'This ' . ($laptop->model ?? 'product') . ' exceeded my expectations. Great build quality and performance. Highly recommended for anyone looking for a reliable ' . ($laptop->category->name ?? 'laptop') . '.'],
                      ['name' => 'Jane Smith', 'date' => '02/28/2024', 'rating' => 4, 'title' => 'Great value for money', 'content' => 'Excellent ' . ($laptop->category->name ?? 'product') . ' at this price point. The ' . ($laptop->brand->name ?? 'brand') . ' quality is evident. Minor issues but overall very satisfied with the purchase.'],
                      ['name' => 'Michael Johnson', 'date' => '02/15/2024', 'rating' => 4.5, 'title' => 'Impressive performance', 'content' => 'The ' . ($laptop->model ?? 'product') . ' performs exceptionally well. Fast delivery and great customer service. Would definitely buy from ' . ($laptop->brand->name ?? 'this brand') . ' again.']
                    ];
                    @endphp

                    @foreach($reviews as $review)
                    <div class="review-item">
                      <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex">
                          <img src="https://via.placeholder.com/50x50?text={{ substr($review['name'], 0, 1) }}" alt="Reviewer" class="reviewer-avatar me-3">
                          <div>
                            <h5 class="reviewer-name mb-1">{{ $review['name'] }}</h5>
                            <div class="review-date text-muted">{{ $review['date'] }}</div>
                          </div>
                        </div>
                        <div class="review-rating text-warning">
                          @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($review['rating']))
                              <i class="bi bi-star-fill"></i>
                            @elseif($i <= $review['rating'])
                              <i class="bi bi-star-half"></i>
                            @else
                              <i class="bi bi-star"></i>
                            @endif
                          @endfor
                        </div>
                      </div>
                      <h5 class="review-title">{{ $review['title'] }}</h5>
                      <div class="review-content">
                        <p>{{ $review['content'] }}</p>
                      </div>
                    </div>
                    @endforeach

                    <div class="text-center mt-4">
                      <button class="btn btn-outline-primary">Load More Reviews</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Related Products -->
        @if($relatedLaptops && $relatedLaptops->count() > 0)
        <div class="row mt-5">
          <div class="col-12">
            <h3 class="mb-4">Related Products</h3>
            <div class="row">
              @foreach($relatedLaptops as $relatedLaptop)
              <div class="col-md-3 mb-4">
                <div class="card h-100">
                  @if($relatedLaptop->images && $relatedLaptop->images->count() > 0)
                    <img src="{{ $relatedLaptop->images->first()->url }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                  @else
                    <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                  @endif
                  <div class="card-body">
                    <h6 class="card-title">{{ $relatedLaptop->brand->name }} {{ $relatedLaptop->model }}</h6>
                    <p class="card-text text-primary fw-bold">${{ number_format($relatedLaptop->price, 2) }}</p>
                    <a href="{{ route('product.show', $relatedLaptop->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @endif
      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Thumbnail image switching
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        const mainImage = document.getElementById('main-product-image');
        
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const newImageSrc = this.dataset.image;
                mainImage.src = newImageSrc;
                
                // Update active thumbnail
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Quantity controls with complete validation
        const decreaseBtn = document.getElementById('decrease-btn');
        const increaseBtn = document.getElementById('increase-btn');
        const quantityInput = document.getElementById('quantity-input');
        const quantitySelector = document.getElementById('quantity-selector');
        
        // Function to completely disable quantity controls
        function disableQuantityControls() {
            quantitySelector.classList.add('disabled');
            decreaseBtn.disabled = true;
            increaseBtn.disabled = true;
            quantityInput.disabled = true;
            quantityInput.readOnly = true;
        }
        
        // Function to enable quantity controls
        function enableQuantityControls() {
            quantitySelector.classList.remove('disabled');
            quantityInput.disabled = false;
            quantityInput.readOnly = false;
            updateQuantityButtons();
        }
        
        // Function to update button states
        function updateQuantityButtons() {
            if (!quantityInput || quantityInput.disabled) return;
            
            const currentValue = parseInt(quantityInput.value) || 1;
            const maxValue = parseInt(quantityInput.max) || 1;
            const minValue = parseInt(quantityInput.min) || 1;
            
            // Update decrease button
            if (currentValue <= minValue) {
                decreaseBtn.disabled = true;
            } else {
                decreaseBtn.disabled = false;
            }
            
            // Update increase button
            if (currentValue >= maxValue) {
                increaseBtn.disabled = true;
            } else {
                increaseBtn.disabled = false;
            }
        }
        
        // Function to validate and set quantity
        function setQuantity(newValue) {
            if (!quantityInput || quantityInput.disabled) return;
            
            const maxValue = parseInt(quantityInput.max) || 1;
            const minValue = parseInt(quantityInput.min) || 1;
            
            // Ensure value is within bounds
            if (newValue < minValue) {
                newValue = minValue;
            } else if (newValue > maxValue) {
                newValue = maxValue;
            }
            
            quantityInput.value = newValue;
            updateQuantityButtons();
        }
        
        // Check if product is out of stock
        const stockCount = {{ $laptop->stock ?? 0 }};
        if (stockCount <= 0) {
            disableQuantityControls();
        } else {
            enableQuantityControls();
        }
        
        // Initialize button states
        if (quantityInput && decreaseBtn && increaseBtn && stockCount > 0) {
            updateQuantityButtons();
            
            // Make input readonly to prevent manual typing
            quantityInput.readOnly = true;
            
            // Prevent all input methods
            quantityInput.addEventListener('keydown', function(e) {
                e.preventDefault();
                return false;
            });
            
            quantityInput.addEventListener('keypress', function(e) {
                e.preventDefault();
                return false;
            });
            
            quantityInput.addEventListener('input', function(e) {
                e.preventDefault();
                return false;
            });
            
            quantityInput.addEventListener('paste', function(e) {
                e.preventDefault();
                return false;
            });
            
            quantityInput.addEventListener('wheel', function(e) {
                e.preventDefault();
                return false;
            });
            
            // Decrease button click handler
            decreaseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (this.disabled || quantityInput.disabled) {
                    return false;
                }
                
                const currentValue = parseInt(quantityInput.value) || 1;
                const minValue = parseInt(quantityInput.min) || 1;
                
                if (currentValue > minValue) {
                    setQuantity(currentValue - 1);
                }
                
                return false;
            });
            
            // Increase button click handler
            increaseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (this.disabled || quantityInput.disabled) {
                    return false;
                }
                
                const currentValue = parseInt(quantityInput.value) || 1;
                const maxValue = parseInt(quantityInput.max) || 1;
                
                if (currentValue < maxValue) {
                    setQuantity(currentValue + 1);
                }
                
                return false;
            });
        }

        // Variant selection
        const variantOptions = document.querySelectorAll('.color-option[data-variant-id]');
        const currentPriceElement = document.querySelector('.current-price');
        const stockElement = document.querySelector('.stock-count');
        
        variantOptions.forEach(variant => {
            variant.addEventListener('click', function() {
                const price = this.dataset.price;
                const stock = parseInt(this.dataset.stock) || 0;
                
                // Update price
                if (currentPriceElement && price) {
                    currentPriceElement.textContent = '$' + parseFloat(price).toFixed(2);
                }
                
                // Update stock
                if (stockElement && stock) {
                    stockElement.textContent = '(' + stock + ' items left)';
                }
                
                // Update quantity input max and controls
                if (quantityInput) {
                    quantityInput.max = stock;
                    
                    if (stock <= 0) {
                        disableQuantityControls();
                        quantityInput.value = 0;
                    } else {
                        enableQuantityControls();
                        const currentValue = parseInt(quantityInput.value) || 1;
                        
                        // If current quantity exceeds new stock, reduce it
                        if (currentValue > stock) {
                            setQuantity(stock);
                        } else {
                            updateQuantityButtons();
                        }
                    }
                }
                
                // Update active variant
                variantOptions.forEach(v => v.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Color option selection
        const colorOptions = document.querySelectorAll('.color-option');
        const selectedColorSpan = document.querySelector('.product-colors .selected-option');
        
        colorOptions.forEach(option => {
            option.addEventListener('click', function() {
                const color = this.dataset.color;
                if (color && selectedColorSpan) {
                    selectedColorSpan.textContent = color;
                }
                
                colorOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Size option selection
        const sizeOptions = document.querySelectorAll('.size-option');
        const selectedSizeSpan = document.querySelector('.product-sizes .selected-option');
        
        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                const size = this.dataset.size;
                if (size && selectedSizeSpan) {
                    selectedSizeSpan.textContent = size;
                }
                
                sizeOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
</body>
</html>
