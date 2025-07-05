<x-admin-layout>
    <x-slot:title>
        Chỉnh sửa Sản phẩm
    </x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Edit Laptop: {{ $laptop->model }}</h1>
                <div>
                    <a href="{{ route('admin.laptops.show', $laptop->id) }}" class="btn btn-info me-2">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('admin.laptops.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.laptops.update', $laptop->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.laptops._form', [
                    'laptop' => $laptop, 
                    'isEdit' => true,
                    'brands' => $brands,
                    'categories' => $categories,
                    'promotions' => $promotions
                ])
                
                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-save"></i> Update Laptop
                        </button>
                        <a href="{{ route('admin.laptops.show', $laptop->id) }}" class="btn btn-secondary me-2">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('admin.laptops.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>