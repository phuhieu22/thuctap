@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h3 mb-1">Brand Management</h2>
                    <p class="text-muted mb-0">Edit brand information</p>
                </div>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Brand: {{ $brand->name }}
                    </h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Brand Name Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">
                                Brand Name <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-tag"></i>
                                </span>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    name="name" 
                                    id="name" 
                                    placeholder="Enter brand name"
                                    value="{{ old('name', $brand->name) }}"
                                    required
                                />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="bi bi-info-circle"></i> Enter a unique and descriptive brand name
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <small class="text-muted">
                                <span class="text-danger">*</span> Required fields
                            </small>
                            <div class="btn-group">
                                <a href="{{ route('admin.brands.show', $brand->id) }}" class="btn btn-outline-info">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-check-lg"></i> Update Brand
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Brand Information Card -->
            <div class="card mt-4 border-info">
                <div class="card-header bg-info bg-opacity-10">
                    <h6 class="card-title mb-0 text-info">
                        <i class="bi bi-info-circle"></i> Brand Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">ID:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge bg-secondary">#{{ $brand->id }}</span>
                                </dd>
                                <dt class="col-sm-4">Current Name:</dt>
                                <dd class="col-sm-8">{{ $brand->name }}</dd>
                                <dt class="col-sm-4">Created:</dt>
                                <dd class="col-sm-8">
                                    <small class="text-muted">{{ $brand->created_at->format('M d, Y') }}</small>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Status:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge bg-success">Active</span>
                                </dd>
                                <dt class="col-sm-4">Products:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge bg-primary">{{ $brand->products_count ?? 0 }}</span>
                                </dd>
                                <dt class="col-sm-4">Updated:</dt>
                                <dd class="col-sm-8">
                                    <small class="text-muted">{{ $brand->updated_at->format('M d, Y') }}</small>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action History Card -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-clock-history"></i> Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.brands.show', $brand->id) }}" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-eye"></i> View Details
                        </a>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-list"></i> All Brands
                        </a>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash"></i> Delete Brand
                        </button>
                    </div>
                </div>
            </div>

            <!-- Guidelines Card -->
            <div class="card mt-4 border-warning">
                <div class="card-body bg-warning bg-opacity-10">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-warning mb-2">Edit Guidelines</h6>
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-1">
                                    <i class="bi bi-check-circle text-success"></i> Make sure the brand name is still unique
                                </li>
                                <li class="mb-1">
                                    <i class="bi bi-check-circle text-success"></i> Consider impact on existing products
                                </li>
                                <li class="mb-1">
                                    <i class="bi bi-check-circle text-success"></i> Changes will be reflected immediately
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle"></i> Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the brand <strong>"{{ $brand->name }}"</strong>?</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> This action cannot be undone!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Delete Brand
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection