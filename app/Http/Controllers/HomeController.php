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

        $foodPosts = Post::published()
            ->with(['user', 'category'])
            ->whereHas('category', function ($q) {
                $q->where('name', 'like', '%Ẩm thực%');
            })
            ->latest()
            ->take(3)
            ->get();

        $destinationPosts = Post::published()
            ->with(['user', 'category'])
            ->whereHas('category', function ($q) {
                $q->where('name', 'like', '%Điểm đến%');
            })
            ->latest()
            ->take(3)
            ->get();

        $checkinPosts = Post::published()
            ->with(['user', 'category'])
            ->whereHas('category', function ($q) {
                $q->where('name', 'like', '%Checkin%');
            })
            ->latest()
            ->take(3)
            ->get();

        $categories = Category::withCount(['posts' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        return view('home', compact('featuredPosts', 'latestPosts', 'foodPosts', 'destinationPosts', 'checkinPosts', 'categories'));
    }
}
