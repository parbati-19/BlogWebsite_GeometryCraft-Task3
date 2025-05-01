@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Forgot Password</h2>
    @if (session('status'))
        <div class="text-green-600 mb-2">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Enter your email" class="block w-full p-2 mb-3 border" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Send Reset Link</button>
    </form>
</div>
@endsection
