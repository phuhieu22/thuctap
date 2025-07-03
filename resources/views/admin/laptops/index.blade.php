<x-admin-layout>
    <x-slot:title>
        Danh sách Sản phẩm
    </x-slot:title>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Laptops Management</h1>
                <a href="{{ route('laptops.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add New Laptop
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Laptops</h5>
                </div>
                <div class="card-body">
                    @if($laptops->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Model Name</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock Count</th>
                                        <th>Images</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laptops as $laptop)
                                        <tr>
                                            <td>{{ $laptop->id }}</td>
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
                                                <span class="badge bg-secondary">{{ $laptop->category->name }}</span>
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
                                                @if($laptop->images->count() > 0)
                                                    <span class="badge bg-info">{{ $laptop->images->count() }} image(s)</span>
                                                @else
                                                    <span class="badge bg-warning">No images</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('laptops.show', $laptop->id) }}" 
                                                       class="btn btn-info btn-sm" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('laptops.edit', $laptop->id) }}" 
                                                       class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('laptops.destroy', $laptop->id) }}" 
                                                          style="display: inline-block;"
                                                          onsubmit="return confirm('Are you sure you want to delete this laptop?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(method_exists($laptops, 'links'))
                            <div class="mt-4">
                                {{ $laptops->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-laptop fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No laptops found</h4>
                            <p class="text-muted">Start by adding your first laptop.</p>
                            <a href="{{ route('laptops.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add New Laptop
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>      
</x-admin-layout>