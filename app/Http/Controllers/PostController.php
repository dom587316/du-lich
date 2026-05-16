<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with(['user', 'category']);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            default:
                $query->latest();
        }

        $posts = $query->paginate(9)->withQueryString();
        $categories = Category::withCount(['posts' => fn($q) => $q->published()])->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published' && (!auth()->check() || auth()->id() !== $post->user_id)) {
            abort(404);
        }

        $post->increment('views_count');
        $post->load(['user', 'category', 'approvedComments.user', 'ratings']);

        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        $userRating = null;
        if (auth()->check()) {
            $userRating = $post->ratings()->where('user_id', auth()->id())->first();
        }

        return view('posts.show', compact('post', 'relatedPosts', 'userRating'));
    }

    public function comment(CommentRequest $request, Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'is_approved' => true,
        ]);

        return back()->with('success', 'Bình luận của bạn đã được đăng!');
    }

    public function toggleFavorite(Post $post)
    {
        $user = auth()->user();
        $favorite = $post->favorites()->where('user_id', $user->id)->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Đã bỏ lưu bài viết.');
        }

        $post->favorites()->create(['user_id' => $user->id]);
        return back()->with('success', 'Đã lưu bài viết yêu thích!');
    }

    public function rate(Request $request, Post $post)
    {
        $request->validate([
            'score' => 'required|integer|min:1|max:5',
        ]);

        $post->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['score' => $request->score]
        );

        return back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }

    public function favorites()
    {
        $posts = auth()->user()->favoritePosts()
            ->published()
            ->with(['user', 'category'])
            ->latest('favorites.created_at')
            ->paginate(9);

        return view('posts.favorites', compact('posts'));
    }
}
