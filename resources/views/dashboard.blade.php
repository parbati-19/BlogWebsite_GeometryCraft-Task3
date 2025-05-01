@extends('layouts.app')
@section('content')
<h1>Welcome, {{ auth()->user()->full_name }}!</h1>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>


@endsection
