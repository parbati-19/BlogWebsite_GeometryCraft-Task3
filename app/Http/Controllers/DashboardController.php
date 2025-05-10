<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $posts = Post::latest()->take(4)->get(); 
        return view('dashboard', compact('posts'));
    } 
}
