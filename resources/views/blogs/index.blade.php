@extends('layouts.app')

@section('content')
    <h2>Approved Blogs</h2>
    @foreach ($blogs as $blog)
        <h3>{{ $blog->title }}</h3>
        <p>{{ $blog->content }}</p>
    @endforeach
@endsection
