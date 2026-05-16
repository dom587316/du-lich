<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::published()
            ->with(['user', 'category'])
            ->popular()
            ->take(3)
            ->get();

        $latestPosts = Post::published()
            ->with(['user', 'category'])
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount(['posts' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        return view('home', compact('featuredPosts', 'latestPosts', 'categories'));
    }
}
