@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 mt-5">
                    <div class="card-body p-4">
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">My Blogs</h3>
                            @if (auth()->user()->role_id != 1)
                                <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                                    Create Blog
                                </a>
                            @endif
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Approve Status</th>
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
                                                <span class="badge {{ $blog->is_approved ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $blog->is_approved ? 'Approved' : 'Pending' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('blogs.toggle-status', $blog->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input"
                                                            onchange="this.form.submit()"
                                                            {{ $blog->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label">
                                                            {{ $blog->is_active ? 'Active' : 'Inactive' }}
                                                        </label>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('blogs.show', $blog) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirmDelete()">
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
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this blog?');
        }
    </script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
