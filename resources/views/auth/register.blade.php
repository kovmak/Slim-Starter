@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <h1>Register</h1>
    <form method="POST" action="/register">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
@endsection
