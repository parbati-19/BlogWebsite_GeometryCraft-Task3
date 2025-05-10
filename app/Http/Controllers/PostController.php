<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->take(4)->get(); // You can change the number to however many you want
        return view('posts.index', compact('posts'));
    } 

    // Show single post (for visitors)
    public function show($id)
    {
        $post = Post::findOrFail($id); // Find post by ID
        return view('posts.show', compact('post'));
    }

    // Show the form to create a new post (for writers)
    public function create()
    {
        return view('posts.create');
    }

    // Store the new post (for writers)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published_date' => 'required|date',
            'category' => 'required|in:Technology,Personal,World,Work',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload if exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'published_date' => $request->published_date,
            'category' => $request->category,
            'image' => $imagePath, // Store the image path
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    // Edit the post (for writers)
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Update the post (for writers)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published_date' => 'required|date',
            'category' => 'required|in:Technology,Personal,World,Work',
            'image' => 'nullable|image',
        ]);

        $post = Post::findOrFail($id);

        // Handle the image upload if exists
        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'published_date' => $request->published_date,
            'category' => $request->category,
            'image' => $imagePath, // Update the image path
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    // Delete the post (for writers)
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
