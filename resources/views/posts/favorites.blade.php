@extends('layouts.app')
@section('title', 'Bài viết yêu thích')
@section('content')
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-heart text-danger me-2"></i> Bài viết <span class="gradient-text">Yêu thích</span></h2>
            <p>Những bài viết bạn đã lưu</p>
        </div>
        @if($posts->count())
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card-glass h-100">
                    <div class="card-img-wrapper">
                        <img src="{{ $post->image_url }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-img-overlay-gradient"></div>
                        <div class="position-absolute top-0 start-0 p-3"><span class="badge-category">{{ $post->category->name }}</span></div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="meta-info"><span><i class="fas fa-user me-1"></i>{{ $post->user->name }}</span></div>
                            <form method="POST" action="{{ route('posts.favorite', $post) }}">@csrf
                                <button type="submit" class="btn btn-favorite active btn-sm"><i class="fas fa-heart me-1"></i>Bỏ lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">{{ $posts->links() }}</div>
        @else
        <div class="card-glass p-5 text-center">
            <i class="fas fa-heart fa-3x text-secondary mb-3"></i>
            <h4>Chưa có bài viết yêu thích</h4>
            <p class="text-secondary">Hãy lưu những bài viết bạn thích!</p>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-custom">Khám phá bài viết</a>
        </div>
        @endif
    </div>
</section>
@endsection
