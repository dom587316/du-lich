@extends('layouts.app')
@section('title', $post->title)
@section('content')
<article class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card-glass p-4 p-md-5 mb-4">
                    <div class="mb-4">
                        <div class="d-flex gap-2 mb-3 flex-wrap">
                            <a href="{{ route('posts.index', ['category' => $post->category->slug]) }}" class="badge-category text-decoration-none">{{ $post->category->name }}</a>
                            @if($post->location)
                            <span class="badge-category" style="background:rgba(249,115,22,0.2);color:#f97316;border-color:rgba(249,115,22,0.3);">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $post->location }}
                            </span>
                            @endif
                        </div>
                        <h1 class="fw-bold mb-3" style="font-size:2rem;line-height:1.3;">{{ $post->title }}</h1>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $post->user->avatar_url }}" alt="" class="user-avatar" style="width:40px;height:40px;">
                                <div>
                                    <div class="fw-bold" style="font-size:0.9rem;">{{ $post->user->name }}</div>
                                    <small class="text-secondary">{{ $post->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                            </div>
                            <div class="meta-info ms-auto">
                                <span><i class="fas fa-eye me-1"></i>{{ number_format($post->views_count) }}</span>
                                <span><i class="fas fa-comment me-1"></i>{{ $post->approvedComments->count() }}</span>
                                <span class="stars">
                                    @for($i=1;$i<=5;$i++)<i class="fas fa-star{{ $i<=round($post->average_rating)?'':' empty' }}"></i>@endfor
                                    <small class="text-secondary">({{ $post->rating_count }})</small>
                                </span>
                            </div>
                        </div>
                    </div>
                    @if($post->image)
                    <div class="mb-4 rounded-3 overflow-hidden">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-100" style="max-height:500px;object-fit:cover;">
                    </div>
                    @endif
                    <div class="post-content" style="line-height:1.8;color:var(--text-secondary);font-size:1.05rem;">{!! $post->content !!}</div>
                    <div class="d-flex gap-3 mt-4 pt-4 flex-wrap" style="border-top:1px solid var(--glass-border);">
                        @auth
                        <form method="POST" action="{{ route('posts.favorite', $post) }}">@csrf
                            <button type="submit" class="btn btn-favorite {{ $post->isFavoritedBy(auth()->user()) ? 'active' : '' }}">
                                <i class="fas fa-heart me-1"></i>{{ $post->isFavoritedBy(auth()->user()) ? 'Đã lưu' : 'Lưu yêu thích' }}
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>

                @auth
                <div class="card-glass p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-star text-warning me-2"></i>Đánh giá bài viết</h5>
                    <form method="POST" action="{{ route('posts.rate', $post) }}" class="d-flex align-items-center gap-3">@csrf
                        <div class="rating-input d-flex gap-1">
                            @for($i=5;$i>=1;$i--)
                            <input type="radio" name="score" value="{{ $i }}" id="star{{ $i }}" {{ $userRating && $userRating->score==$i ? 'checked' : '' }} style="display:none;">
                            <label for="star{{ $i }}" class="fs-4" style="cursor:pointer;color:{{ $userRating && $userRating->score>=$i ? '#fbbf24' : '#64748b' }};transition:color 0.2s;">
                                <i class="fas fa-star"></i>
                            </label>
                            @endfor
                        </div>
                        <button type="submit" class="btn btn-primary-custom btn-sm">Gửi</button>
                        @if($userRating)<span class="text-secondary small">Đã đánh giá {{ $userRating->score }}/5</span>@endif
                    </form>
                </div>
                @endauth

                <div class="card-glass p-4 mb-4">
                    <h5 class="fw-bold mb-4"><i class="fas fa-comments me-2" style="color:var(--primary);"></i>Bình luận ({{ $post->approvedComments->count() }})</h5>
                    @auth
                    <form method="POST" action="{{ route('posts.comment', $post) }}" class="mb-4">@csrf
                        <div class="d-flex gap-3">
                            <img src="{{ auth()->user()->avatar_url }}" alt="" class="user-avatar" style="width:40px;height:40px;flex-shrink:0;">
                            <div class="flex-grow-1">
                                <textarea name="content" class="form-control form-control-dark" rows="3" placeholder="Viết bình luận..." required>{{ old('content') }}</textarea>
                                @error('content')<small class="text-danger">{{ $message }}</small>@enderror
                                <button type="submit" class="btn btn-primary-custom btn-sm mt-2"><i class="fas fa-paper-plane me-1"></i>Gửi</button>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="card-glass p-3 mb-4 text-center" style="background:rgba(14,165,233,0.05);"><a href="{{ route('login') }}" style="color:var(--primary);">Đăng nhập</a> để bình luận</div>
                    @endauth
                    @forelse($post->approvedComments as $comment)
                    <div class="d-flex gap-3 mb-3 pb-3" style="border-bottom:1px solid var(--glass-border);">
                        <img src="{{ $comment->user->avatar_url }}" alt="" class="user-avatar" style="width:36px;height:36px;flex-shrink:0;">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold" style="font-size:0.9rem;">{{ $comment->user->name }}</span>
                                <small class="text-secondary">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0 text-secondary">{{ $comment->content }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-secondary text-center">Chưa có bình luận nào.</p>
                    @endforelse
                </div>
            </div>
            <div class="col-lg-4">
                @if($relatedPosts->count())
                <div class="card-glass p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-link me-2" style="color:var(--primary);"></i>Bài viết liên quan</h5>
                    @foreach($relatedPosts as $related)
                    <a href="{{ route('posts.show', $related->slug) }}" class="d-flex gap-3 mb-3 text-decoration-none">
                        <img src="{{ $related->image_url }}" alt="" style="width:80px;height:60px;object-fit:cover;border-radius:8px;flex-shrink:0;">
                        <div>
                            <h6 class="text-white mb-1" style="font-size:0.85rem;">{{ Str::limit($related->title, 50) }}</h6>
                            <small class="text-secondary"><i class="fas fa-eye me-1"></i>{{ number_format($related->views_count) }}</small>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif
                <div class="card-glass p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-folder me-2" style="color:var(--primary);"></i>Danh mục</h5>
                    @php $allCats = \App\Models\Category::withCount(['posts'=>fn($q)=>$q->published()])->get(); @endphp
                    @foreach($allCats as $cat)
                    <a href="{{ route('posts.index', ['category'=>$cat->slug]) }}" class="d-flex justify-content-between py-2 text-decoration-none" style="border-bottom:1px solid var(--glass-border);">
                        <span class="text-secondary">{{ $cat->name }}</span>
                        <span class="badge-category">{{ $cat->posts_count }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</article>
@push('scripts')
<script>
function highlightStars(r){document.querySelectorAll('.rating-input label').forEach((l,i)=>{l.style.color=(5-i)<=r?'#fbbf24':'#64748b';})}
function resetStars(){const c=document.querySelector('.rating-input input:checked');const v=c?parseInt(c.value):0;document.querySelectorAll('.rating-input label').forEach((l,i)=>{l.style.color=(5-i)<=v?'#fbbf24':'#64748b';})}
document.querySelectorAll('.rating-input label').forEach(l=>{l.addEventListener('mouseover',function(){highlightStars(parseInt(this.previousElementSibling.value));});l.addEventListener('mouseout',resetStars);l.addEventListener('click',function(){setTimeout(resetStars,50);});});
</script>
@endpush
@endsection
