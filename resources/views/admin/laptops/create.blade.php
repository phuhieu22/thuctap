<x-admin-layout>
    <x-slot:title>
        Tạo Sản phẩm
    </x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Add New Laptop</h1>
                <a href="{{ route('admin.laptops.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>

            <form method="POST" action="{{ route('admin.laptops.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.laptops._form', [
                    'laptop' => null, 
                    'isEdit' => false,
                    'brands' => $brands,
                    'categories' => $categories,
                    'promotions' => $promotions
                ])
                
                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="fas fa-save"></i> Create Laptop
                        </button>
                        <a href="{{ route('admin.laptops.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>