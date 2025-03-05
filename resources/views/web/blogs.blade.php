@extends('layouts.web')

@section('content')
    <div class="container">
        <h1 class="text-center text-primary my-4">All Blogs</h1>

        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}"
                            style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text text-muted">By: <strong>{{ $blog->user->name }}</strong></p>
                            <p class="text-truncate" style="max-width: 100%;">{{ Str::limit($blog->content, 100) }}</p>

                            <a href="{{ route('blogs.view', $blog) }}" class="btn btn-primary btn-sm">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($blogs->isEmpty())
            <div class="alert alert-warning text-center">No blogs available at the moment.</div>
        @endif
    </div>
@endsection
