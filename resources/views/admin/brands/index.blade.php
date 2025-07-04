@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-1 text-dark fw-bold">Brand Management</h1>
                <p class="text-muted mb-0">Manage your brand collection</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>Create New Brand
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Main Content Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title mb-0 text-primary fw-semibold">
                            <i class="bi bi-tags me-2"></i>All Brands
                        </h5>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-primary fs-6">{{ count($brands) }} Total</span>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                @if (count($brands) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 px-4 py-3 fw-semibold text-muted">ID</th>
                                    <th class="border-0 px-4 py-3 fw-semibold text-muted">Brand Name</th>
                                    <th class="border-0 px-4 py-3 fw-semibold text-muted text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td class="px-4 py-3 align-middle">
                                            <span class="badge bg-light text-dark border">#{{ $brand->id }}</span>
                                        </td>
                                        <td class="px-4 py-3 align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="bi bi-tag text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-semibold">{{ $brand->name }}</h6>
                                                    <small class="text-muted">Brand ID: {{ $brand->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 align-middle text-center">
                                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="post"
                                                enctype="multipart/form-data" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Do you want to delete')" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Table Footer -->
                    <div class="card-footer bg-light border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <small class="text-muted">
                                    Showing {{ count($brands) }} of {{ count($brands) }} brands
                                </small>
                            </div>
                            <div class="col-auto">
                                <small class="text-muted fw-semibold">
                                    Total: {{ count($brands) }} brands
                                </small>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-2">No Brands Found</h4>
                        <p class="text-muted mb-4">Start by creating your first brand to get started</p>
                        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>Create First Brand
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
