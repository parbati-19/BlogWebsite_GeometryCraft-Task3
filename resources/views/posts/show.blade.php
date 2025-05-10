@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-semibold">{{ $post->title }}</h1>
            <p class="text-gray-500 mt-2">{{ $post->published_date }}</p>
            <p class="text-gray-600 mt-4">{{ $post->description }}</p>

            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mt-6 w-full h-96 object-cover rounded-lg">
            @endif
        </div>
    </div>
@endsection
