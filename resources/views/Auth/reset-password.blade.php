@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Reset Password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" placeholder="Your email" class="block w-full p-2 mb-3 border" required>
        <input type="password" name="password" placeholder="New Password" class="block w-full p-2 mb-3 border" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="block w-full p-2 mb-3 border" required>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Reset Password</button>
    </form>
</div>
@endsection
