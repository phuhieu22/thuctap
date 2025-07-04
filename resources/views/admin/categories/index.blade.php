@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Categories</h1>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Create
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        @if ($categories->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th width="200">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                        class="btn btn-warning btn-sm me-1">
                                                        <i class="fas fa-edit me-1"></i>Edit
                                                    </a>

                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Bạn chắc chắn muốn xóa category này?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash me-1"></i>Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if (method_exists($categories, 'links'))
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $categories->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <p class="text-muted mb-3">Chưa có category nào</p>
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>Tạo category đầu tiên
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
