<x-admin-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>
    
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Admin Dashboard</h1>
                <div class="text-muted">{{ now()->format('l, F j, Y') }}</div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="fw-bold">{{ \App\Models\Laptop::count() }}</h4>
                                    <p class="mb-0">Total Laptops</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-laptop fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-primary bg-opacity-75">
                            <a href="{{ route('admin.laptops.index') }}" class="text-white text-decoration-none">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="fw-bold">{{ \App\Models\Brand::count() }}</h4>
                                    <p class="mb-0">Brands</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-tags fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-success bg-opacity-75">
                            <span class="text-white">Brand Management</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="fw-bold">{{ \App\Models\Category::count() }}</h4>
                                    <p class="mb-0">Categories</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-list fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-info bg-opacity-75">
                            <a href="{{ route('admin.categories.index') }}" class="text-white text-decoration-none">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="fw-bold">{{ \App\Models\LaptopVariant::sum('stock') + \App\Models\Laptop::sum('stock') }}</h4>
                                    <p class="mb-0">Total Stock</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-boxes fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-warning bg-opacity-75">
                            <span class="text-dark">Inventory Status</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.laptops.create') }}" class="btn btn-success w-100 h-100 d-flex flex-column justify-content-center align-items-center py-4">
                                        <i class="fas fa-plus fa-2x mb-2"></i>
                                        <span>Add New Laptop</span>
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.laptops.index') }}" class="btn btn-primary w-100 h-100 d-flex flex-column justify-content-center align-items-center py-4">
                                        <i class="fas fa-laptop fa-2x mb-2"></i>
                                        <span>Manage Laptops</span>
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-info w-100 h-100 d-flex flex-column justify-content-center align-items-center py-4">
                                        <i class="fas fa-list fa-2x mb-2"></i>
                                        <span>Manage Categories</span>
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="btn btn-outline-secondary w-100 h-100 d-flex flex-column justify-content-center align-items-center py-4">
                                        <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                        <span>Reports</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Laptops -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Recent Laptops</h5>
                            <a href="{{ route('admin.laptops.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
                        </div>
                        <div class="card-body">
                            @php
                                $recentLaptops = \App\Models\Laptop::with(['brand', 'category', 'images'])
                                    ->latest()
                                    ->take(5)
                                    ->get();
                            @endphp
                            
                            @if($recentLaptops->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
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
                                            @foreach($recentLaptops as $laptop)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if($laptop->images->first())
                                                                <img src="{{ $laptop->images->first()->url }}" 
                                                                     class="me-3 rounded" 
                                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                                            @else
                                                                <div class="me-3 rounded bg-light d-flex align-items-center justify-content-center" 
                                                                     style="width: 40px; height: 40px;">
                                                                    <i class="fas fa-laptop text-muted"></i>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <div class="fw-bold">{{ $laptop->model }}</div>
                                                                <small class="text-muted">{{ $laptop->created_at->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-primary">{{ $laptop->brand->name }}</span></td>
                                                    <td class="fw-bold text-success">${{ number_format($laptop->price, 2) }}</td>
                                                    <td>
                                                        <span class="badge {{ $laptop->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $laptop->stock }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('admin.laptops.show', $laptop->id) }}" 
                                                               class="btn btn-outline-info" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('admin.laptops.edit', $laptop->id) }}" 
                                                               class="btn btn-outline-primary" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-laptop fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">No laptops found</h6>
                                    <a href="{{ route('admin.laptops.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Add Your First Laptop
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">System Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Storage Usage</span>
                                    <span>75%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" style="width: 75%"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Database</span>
                                    <span class="text-success">Online</span>
                                </div>
                                <small class="text-muted">Last backup: {{ now()->subHours(2)->diffForHumans() }}</small>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Active Users</span>
                                    <span class="fw-bold">1</span>
                                </div>
                                <small class="text-muted">Last login: {{ now()->format('H:i') }}</small>
                            </div>

                            <hr>
                            
                            <div class="d-grid">
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-cog"></i> System Settings
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
