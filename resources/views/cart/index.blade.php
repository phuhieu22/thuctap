<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <style>
        .header {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .top-bar {
            background: #f8f9fa;
            font-size: 14px;
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
    </style>
</head>

<body>
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
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                        </button>
                        <button class="btn btn-link position-relative">
                            <i class="bi bi-cart3"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
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
                            <a class="nav-link" href="{{ route('cart.view') }}">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <h3>Giỏ hàng của bạn</h3>


    <table class="table table-borderless border-start border-end">
        <thead>
            <tr class="border-bottom">
                <th></th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Biến thể</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody class="border-bottom">
            @foreach ($cartItems as $item)
                <tr>
                    <td>
                        <input type="checkbox" name="cart_item_ids[]" value="{{ $item->id }}">
                    </td>
                    <td>
                        @if ($item->laptopVariant->laptop->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $item->laptopVariant->laptop->images->first()->path) }}"
                                alt="Ảnh sản phẩm" width="80">
                        @endif
                    </td>
                    <td>{{ $item->laptopVariant->laptop->model }}</td>
                    <td>{{ $item->laptopVariant->variant_name }}</td>
                    <td>{{ number_format($item->laptopVariant->price) }} VNĐ</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="action" value="decrease"
                                    class="btn btn-sm btn-outline-secondary me-1"
                                    {{ $item->quantity <= 1 ? 'disabled' : '' }}>–</button>

                                <span class="px-2">{{ $item->quantity }}</span>

                                <button type="submit" name="action" value="increase"
                                    class="btn btn-sm btn-outline-secondary ms-1"
                                    {{ $item->quantity >= $item->laptopVariant->stock ? 'disabled' : '' }}>+</button>
                            </form>
                        </div>
                    </td>
                    <td>{{ number_format($item->quantity * $item->laptopVariant->price) }} VNĐ</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="d-flex justify-content-end mt-3 me-2 mr-5">
        <a href="" class="btn btn-secondary me-3">
            <i class="bi bi-arrow-left me-2"></i> Quay lại
        </a>
        <form action="{{ route('checkout.form') }}" method="GET">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-cash-coin me-1"></i> Thanh toán
            </button>
        </form>

    </div>
</body>
</html>
