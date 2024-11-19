@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>
    <form method="POST" action="/posts/{{ $post['id'] }}">
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $post['title'] }}" required>

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="5" required>{{ $post['content'] }}</textarea>

        <button type="submit">Update</button>
    </form>
@endsection
