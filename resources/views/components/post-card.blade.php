<div class="col-lg-4 col-md-6 animate-fade-in-up">
    <div class="card-glass h-100">
        <div class="card-img-wrapper">
            <img src="{{ $post->image_url }}" class="card-img-top" alt="{{ $post->title }}">
            <div class="card-img-overlay-gradient"></div>
            <div class="position-absolute top-0 start-0 p-3 z-3">
                <span class="badge-category bg-white shadow-sm">{{ $post->category->name }}</span>
            </div>
            @if(isset($showViews) && $showViews)
            <div class="position-absolute top-0 end-0 p-3 z-3">
                <span class="badge bg-warning text-dark fw-bold shadow-sm">
                    <i class="fas fa-eye me-1"></i>{{ number_format($post->views_count) }}
                </span>
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
                    <span><i class="fas fa-user me-1"></i> {{ $post->user->name }}</span>
                    @if(isset($showDate) && $showDate)
                    <span><i class="fas fa-calendar me-1"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                    @endif
                </div>
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star{{ $i <= $post->average_rating ? '' : ' empty' }}" style="font-size: 0.8rem;"></i>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
