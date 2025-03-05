@extends('layouts.app')

@section('content')
    <h2>Submit a Blog</h2>
    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <button type="submit">Submit</button>
    </form>
@endsection
