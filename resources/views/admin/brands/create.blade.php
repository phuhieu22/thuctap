@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h3 mb-1">Brand Management</h2>
                    <p class="text-muted mb-0">Create a new brand for your store</p>
                </div>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-plus-circle"></i> Create New Brand
                    </h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
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
                                    value="{{ old('name') }}"
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
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i> Create Brand
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Success Alert (if needed) -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Guidelines Card -->
            <div class="card mt-4 border-info">
                <div class="card-body bg-info bg-opacity-10">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-info mb-2">Brand Guidelines</h6>
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-1">
                                    <i class="bi bi-check-circle text-success"></i> Brand names should be unique and descriptive
                                </li>
                                <li class="mb-1">
                                    <i class="bi bi-check-circle text-success"></i> Use proper capitalization for brand names
                                </li>
                                <li class="mb-1">
                                    <i class="bi bi-check-circle text-success"></i> Avoid special characters except hyphens and spaces
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Brands Card -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-clock-history"></i> Recent Brands
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span class="badge bg-primary rounded-pill">Nike</span>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span class="badge bg-success rounded-pill">Adidas</span>
                                    <small class="text-muted">5 days ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span class="badge bg-warning rounded-pill">Puma</span>
                                    <small class="text-muted">1 week ago</small>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    <span class="badge bg-info rounded-pill">Reebok</span>
                                    <small class="text-muted">2 weeks ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection