<x-admin-layout>
    <x-slot:title>
        Chi tiết Danh mục
    </x-slot:title>
    
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">{{ $category->name }}</h1>
                <div>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- Category Information -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Category Information</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Name:</td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Slug:</td>
                                    <td>
                                        @if($category->slug)
                                            <code>{{ $category->slug }}</code>
                                        @else
                                            <span class="text-muted">No slug</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Status:</td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Laptops Count:</td>
                                    <td>
                                        <span class="badge bg-info">{{ $category->laptops->count() }} laptop(s)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Created:</td>
                                    <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Updated:</td>
                                    <td>{{ $category->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Description</h5>
                        </div>
                        <div class="card-body">
                            @if($category->description)
                                <p>{{ $category->description }}</p>
                            @else
                                <p class="text-muted">No description available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laptops in this Category -->
            @if($category->laptops->count() > 0)
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Laptops in this Category</h5>
                        <span class="badge bg-info">{{ $category->laptops->count() }} item(s)</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Model</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->laptops as $laptop)
                                        <tr>
                                            <td>
                                                <strong>{{ $laptop->model }}</strong>
                                                @if($laptop->variants->count() > 0)
                                                    <small class="text-muted d-block">
                                                        {{ $laptop->variants->count() }} variant(s)
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $laptop->brand->name }}</span>
                                            </td>
                                            <td>
                                                <strong>${{ number_format($laptop->price, 2) }}</strong>
                                                @if($laptop->variants->count() > 0)
                                                    <small class="text-muted d-block">
                                                        Variants: ${{ number_format($laptop->variants->min('price'), 2) }} - ${{ number_format($laptop->variants->max('price'), 2) }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $laptop->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $laptop->stock + $laptop->variants->sum('stock') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.laptops.show', $laptop->id) }}" 
                                                       class="btn btn-info btn-sm" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.laptops.edit', $laptop->id) }}" 
                                                       class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-laptop fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No laptops in this category</h4>
                        <p class="text-muted">Start by adding laptops to this category.</p>
                        <a href="{{ route('admin.laptops.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add New Laptop
                        </a>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Category
                        </a>
                        @if($category->laptops->count() == 0)
                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" 
                                  style="display: inline-block;"
                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete Category
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
