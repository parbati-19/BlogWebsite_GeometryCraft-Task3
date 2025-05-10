@extends('layouts.app')
@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($posts as $post)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($post->image)
                <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
            @endif

            <div class="p-4">
                <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                <p class="text-sm text-gray-500">{{ $post->published_date->format('F j, Y') }}</p>
                <p class="mt-2 text-gray-600">{{ Str::limit($post->description, 100) }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline mt-3 inline-block">Read more</a>
            </div>
        </div>
    @empty
        <p class="text-gray-600">No posts available.</p>
    @endforelse
</div>

@endsection
