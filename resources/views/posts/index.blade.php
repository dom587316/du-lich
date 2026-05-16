@extends('layouts.app')

@section('title', 'Bài viết')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-newspaper me-2" style="color: var(--primary);"></i> Tất cả <span class="gradient-text">Bài viết</span></h2>
            <p>Khám phá những bài viết du lịch hữu ích</p>
        </div>

        <!-- Filters -->
        <div class="card-glass p-3 mb-4">
            <form action="{{ route('posts.index') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-dark" placeholder="Tìm kiếm..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-control form-control-dark">
                        <option value="">Tất cả danh mục</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }} ({{ $cat->posts_count }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" name="location" class="form-control form-control-dark" placeholder="Địa điểm..." value="{{ request('location') }}">
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-control form-control-dark">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        @if(request()->anyFilled(['search', 'category', 'location']))
        <div class="mb-3 d-flex align-items-center gap-2 flex-wrap">
            <span class="text-secondary">Kết quả cho:</span>
            @if(request('search'))
            <span class="badge-category">"{{ request('search') }}"</span>
            @endif
            @if(request('category'))
            <span class="badge-category"><i class="fas fa-folder me-1"></i>{{ request('category') }}</span>
            @endif
            @if(request('location'))
            <span class="badge-category"><i class="fas fa-map-marker-alt me-1"></i>{{ request('location') }}</span>
            @endif
            <a href="{{ route('posts.index') }}" class="text-danger small"><i class="fas fa-times me-1"></i>Xóa bộ lọc</a>
        </div>
        @endif

        @if($posts->count())
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6 animate-fade-in-up">
                <div class="card-glass h-100">
                    <div class="card-img-wrapper">
                        <img src="{{ $post->image_url }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-img-overlay-gradient"></div>
                        <div class="position-absolute top-0 start-0 p-3">
                            <span class="badge-category">{{ $post->category->name }}</span>
                        </div>
                        @if($post->location)
                        <div class="position-absolute bottom-0 start-0 p-3">
                            <span class="text-white small"><i class="fas fa-map-marker-alt me-1"></i>{{ $post->location }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                        </h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="meta-info">
                                <span><i class="fas fa-eye me-1"></i>{{ number_format($post->views_count) }}</span>
                                <span><i class="fas fa-comment me-1"></i>{{ $post->comments_count ?? $post->comments()->count() }}</span>
                            </div>
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= round($post->average_rating) ? '' : ' empty' }}" style="font-size: 0.75rem;"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="meta-info mt-2 pt-2" style="border-top: 1px solid var(--glass-border);">
                            <span><i class="fas fa-user me-1"></i>{{ $post->user->name }}</span>
                            <span><i class="fas fa-calendar me-1"></i>{{ $post->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
        @else
        <div class="card-glass p-5 text-center">
            <i class="fas fa-search fa-3x text-secondary mb-3"></i>
            <h4>Không tìm thấy bài viết nào</h4>
            <p class="text-secondary">Thử thay đổi từ khóa hoặc bộ lọc.</p>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-custom">Xem tất cả bài viết</a>
        </div>
        @endif
    </div>
</section>
@endsection
