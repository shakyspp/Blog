@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 mt-5">
                    <div class="card-body p-4">
                        <h1 class="text-center text-primary mb-3">{{ $blog->title }}</h1>

                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $blog->image) }}"
                                 alt="{{ $blog->title }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 350px; object-fit: cover;">
                        </div>

                        <p class="text-muted"><strong>Author:</strong> {{ $blog->user->name }}</p>
                        <p class="text-muted"><strong>Title:</strong> {{ $blog->title }}</p>
                        <p class="lead">{{ $blog->description }}</p>
                        <hr>
                        <p class="text-dark">{{ $blog->content ?? 'N/A' }}</p>
                        <a href="{{ route('blogs.all') }}" class="btn btn-secondary mt-3"> Back to Blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
