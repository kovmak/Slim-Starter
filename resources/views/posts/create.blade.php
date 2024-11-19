@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <h1>Create a New Post</h1>
    <form method="POST" action="/posts">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="5" required></textarea>

        <button type="submit">Publish</button>
    </form>
@endsection
