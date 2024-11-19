@extends('layouts.app')

@section('header')
    <nav class="menu">
        <a href="/">Home</a>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
        <a href="/posts/create">Create Post</a>
    </nav>
@endsection

@section('content')
    <h1>All Posts</h1>

    @if(count($posts) > 0)
        <ul>
            @foreach ($posts as $post)
                <li>
                    <h2><a href="/posts/{{ $post['id'] }}">{{ $post['title'] }}</a></h2>
                    <p>{{ substr($post['content'], 0, 150) }}</p>
                    <p>Posted on {{ $post['created_at'] }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>No posts available.</p>
    @endif
@endsection
