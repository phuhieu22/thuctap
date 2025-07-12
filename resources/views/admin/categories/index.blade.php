<x-admin-layout>
    <x-slot:title>
        Danh sách Danh mục
    </x-slot:title>
    
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Categories Management</h1>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add New Category
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
                    <h5 class="card-title mb-0">All Categories</h5>
                </div>
                <div class="card-body">
                    @if($categories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Laptops Count</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                <strong>{{ $category->name }}</strong>
                                            </td>
                                            <td>
                                                @if($category->description)
                                                    {{ Str::limit($category->description, 50) }}
                                                @else
                                                    <span class="text-muted">No description</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $category->laptops->count() }} laptop(s)
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $category->created_at->format('M d, Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.categories.show', $category->id) }}" 
                                                       class="btn btn-info btn-sm" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                                       class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if($category->laptops->count() == 0)
                                                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" 
                                                              style="display: inline-block;"
                                                              onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-danger btn-sm" disabled title="Cannot delete category with laptops">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(method_exists($categories, 'links'))
                            <div class="mt-4">
                                {{ $categories->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No categories found</h4>
                            <p class="text-muted">Start by adding your first category.</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add New Category
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>      
</x-admin-layout>
