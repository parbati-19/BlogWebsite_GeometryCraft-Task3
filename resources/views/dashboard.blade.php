@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col bg-gray-100">
        <nav class="bg-gray-200 shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0 font-semibold text-lg">
                        {{ Auth::user()->fullname }}
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center gap-6 text-sm">
                        <a href="posts.index" class="hover:underline">Blog</a>
                        <a href="#" class="hover:underline">Projects</a>
                        <a href="#" class="hover:underline">About</a>
                        <a href="#" class="hover:underline">Newsletter</a>

                        <!-- Toggle Button -->
                        <label for="toggle" class="flex items-center cursor-pointer ml-4">
                            <div class="relative">
                                <input type="checkbox" id="toggle" class="sr-only" />
                                <div class="block bg-gray-400 w-14 h-8 rounded-full"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                            </div>
                        </label>
                    </div>

                    <!-- Mobile Hamburger -->
                    <div class="md:hidden">
                        <button id="menu-toggle" class="focus:outline-none">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Items -->
            <div id="mobile-menu" class="md:hidden hidden px-4 pb-3 space-y-2">
                <a href="{{route('posts.index')}}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">Blog</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">Projects</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">About</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">Newsletter</a>
            </div>
        </nav>

        <!-- Big Heading Section -->
        <section class="bg-white py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1
                    class="text-center text-6xl sm:text-7xl md:text-8xl font-extrabold tracking-widest uppercase text-gray-900 whitespace-nowrap overflow-hidden w-full">
                    THE BLOG
                </h1>
            </div>
        </section>

        <!-- Recent Posts Filter Section -->
        <section class=" flex-1 mt-10 px-4 sm:px-6 lg:px-8">
            <h3 class="text-xl font-semibold px-4 sm:px-6 lg:px-8">Recent Blog Posts</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($posts as $post)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full h-48 object-cover">
                        @endif

                        <div class="p-4">
                            <h4 class="text-lg font-semibold">{{ $post->title }}</h4>
                            <p class="text-sm text-gray-500">{{ $post->published_date->format('F j, Y') }}</p>
                            <p class="mt-2 text-gray-600">{{ Str::limit($post->description, 100) }}</p>
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="text-blue-600 hover:underline mt-3 inline-block">Read more</a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No posts available.</p>
                @endforelse
            </div>
        </section>

        <footer>
            <div class="flex items-center h-16 bg-white">
               <span class="px-2"> © Copyright 2025 </span>
               <a class="px-2" href="#">Twitter</a>
               <a class="px-2" href="#">LinkedIn</a>
               <a class="px-2" href="#">Email</a>
               <h4 class="px-2">RSS feed</h4>
               <h4 class="px-2">Add to Feedly</h4>
            </div>
        </footer>


    </div>

    {{-- Toggle Script --}}
    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        toggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

@endsection