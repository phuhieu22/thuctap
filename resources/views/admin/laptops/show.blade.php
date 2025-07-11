<x-admin-layout>
    <x-slot:title>
        Chi tiết Sản phẩm
    </x-slot:title>
    
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">{{ $laptop->model }}</h1>
                <div>
                    <a href="{{ route('admin.laptops.edit', $laptop->id) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.laptops.index') }}" class="btn btn-secondary">
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
                <!-- Basic Information -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Basic Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold">Model:</td>
                                            <td>{{ $laptop->model }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Brand:</td>
                                            <td><span class="badge bg-primary">{{ $laptop->brand->name }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Category:</td>
                                            <td><span class="badge bg-secondary">{{ $laptop->category->name }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Base Price:</td>
                                            <td class="fw-bold text-success">${{ number_format($laptop->price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Base Stock:</td>
                                            <td>
                                                <span class="badge {{ $laptop->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $laptop->stock }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold">Total Stock:</td>
                                            <td>
                                                <span class="badge {{ ($laptop->stock + $laptop->variants->sum('stock')) > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $laptop->stock + $laptop->variants->sum('stock') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Variants:</td>
                                            <td>{{ $laptop->variants->count() }} variant(s)</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Images:</td>
                                            <td>{{ $laptop->images->count() }} image(s)</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Created:</td>
                                            <td>{{ $laptop->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Updated:</td>
                                            <td>{{ $laptop->updated_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            @if($laptop->description)
                                <div class="mt-3">
                                    <h6 class="fw-bold">Description:</h6>
                                    <p class="mb-0">{{ $laptop->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Variants -->
                    @if($laptop->variants->count() > 0)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Variants</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Variant Name</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Specifications</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($laptop->variants as $variant)
                                                <tr>
                                                    <td class="fw-bold">{{ $variant->variant_name }}</td>
                                                    <td class="text-success fw-bold">${{ number_format($variant->price, 2) }}</td>
                                                    <td>
                                                        <span class="badge {{ $variant->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $variant->stock }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($variant->specifications)
                                                            <small>{{ $variant->specifications }}</small>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Promotions -->
                    @if($laptop->promotions->count() > 0)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Active Promotions</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($laptop->promotions as $promotion)
                                        <div class="col-md-6 mb-3">
                                            <div class="card border-warning">
                                                <div class="card-body">
                                                    <h6 class="card-title text-warning">
                                                        <i class="fas fa-tag"></i> {{ $promotion->name }}
                                                    </h6>
                                                    <p class="card-text">
                                                        <span class="badge bg-warning text-dark">{{ $promotion->discount_percentage }}% OFF</span>
                                                    </p>
                                                    @if($promotion->description)
                                                        <small class="text-muted">{{ $promotion->description }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Images -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Product Images</h5>
                        </div>
                        <div class="card-body">
                            @if($laptop->images->count() > 0)
                                <div class="row">
                                    @foreach($laptop->images as $image)
                                        <div class="col-12 mb-3">
                                            <div class="card">
                                                <img src="{{ $image->url }}" class="card-img-top" 
                                                     style="height: 200px; object-fit: cover;"
                                                     data-bs-toggle="modal" 
                                                     data-bs-target="#imageModal{{ $image->id }}"
                                                     style="cursor: pointer;">
                                                <div class="card-body p-2">
                                                    <small class="text-muted">Image {{ $loop->iteration }}</small>
                                                </div>
                                            </div>

                                            <!-- Image Modal -->
                                            <div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ $laptop->model }} - Image {{ $loop->iteration }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ $image->url }}" class="img-fluid" alt="Laptop Image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">No images available</h6>
                                    <a href="{{ route('admin.laptops.edit', $laptop->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-plus"></i> Add Images
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.laptops.edit', $laptop->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Laptop
                                </a>
                                <hr>
                                <form method="POST" action="{{ route('admin.laptops.destroy', $laptop->id) }}" 
                                      onsubmit="return confirm('Are you sure you want to delete this laptop? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-trash"></i> Delete Laptop
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
