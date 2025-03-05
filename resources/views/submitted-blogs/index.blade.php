@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg rounded">
            <div class="card-body p-4">
                <h2 class="mb-4 text-primary">My Blogs</h2>

                @if (auth()->user()->role_id != 1)
                    <a href="{{ route('blogs.create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Create Blog
                    </a>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Approval Status</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @if ($blog->is_approved)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.blogs.toggle-status', $blog->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input"
                                                    onchange="this.form.submit()" {{ $blog->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $blog->is_active ? 'Active' : 'Inactive' }}
                                                </label>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blogs.show', $blog) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                                            style="display:inline;" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this blog?');
        }
    </script>
@endsection
