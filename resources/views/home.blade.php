@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<!-- Hero Section -->
<section class="position-relative overflow-hidden" style="min-height: 85vh; display: flex; align-items: center; background: var(--gradient-hero);">
    <div class="position-absolute w-100 h-100" style="background: url('https://images.unsplash.com/photo-1528127269322-539801943592?w=1920&q=80') center/cover; opacity: 0.15;"></div>
    <div class="position-absolute w-100 h-100" style="background: radial-gradient(circle at 20% 50%, rgba(14, 165, 233, 0.3) 0%, transparent 50%), radial-gradient(circle at 80% 50%, rgba(16, 185, 129, 0.2) 0%, transparent 50%);"></div>
    
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7 animate-fade-in-up">
                <span class="badge-category mb-3 d-inline-block">
                    <i class="fas fa-globe-asia me-1"></i> Khám phá Việt Nam
                </span>
                <h1 class="display-3 fw-bold mb-4" style="line-height: 1.2;">
                    Cẩm nang
                    <span class="gradient-text">Du lịch</span>
                    <br>Trực tuyến
                </h1>
                <p class="fs-5 text-secondary mb-4" style="max-width: 500px;">
                    Chia sẻ kinh nghiệm, khám phá điểm đến mới và tìm cảm hứng cho chuyến đi tiếp theo của bạn.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary-custom btn-lg px-4">
                        <i class="fas fa-compass me-2"></i> Khám phá ngay
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-custom btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i> Tham gia
                    </a>
                    @endguest
                </div>

                <!-- Stats -->
                <div class="d-flex gap-4 mt-5 flex-wrap">
                    <div class="text-center">
                        <div class="fs-3 fw-bold" style="color: var(--primary);">{{ \App\Models\Post::published()->count() }}+</div>
                        <small class="text-secondary">Bài viết</small>
                    </div>
                    <div class="text-center">
                        <div class="fs-3 fw-bold" style="color: var(--secondary);">{{ \App\Models\User::count() }}+</div>
                        <small class="text-secondary">Thành viên</small>
                    </div>
                    <div class="text-center">
                        <div class="fs-3 fw-bold" style="color: var(--accent);">{{ \App\Models\Category::count() }}</div>
                        <small class="text-secondary">Danh mục</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block animate-fade-in-up delay-200">
                <div class="position-relative">
                    <div style="width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(14, 165, 233, 0.2), transparent); position: absolute; top: -50px; right: -50px;"></div>
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=600&q=80" 
                         alt="Du lịch Việt Nam" 
                         class="rounded-4 shadow-lg" 
                         style="width: 100%; max-width: 450px; border: 3px solid var(--glass-border); transform: rotate(3deg);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Bar -->
<section class="py-4" style="margin-top: -40px; position: relative; z-index: 10;">
    <div class="container">
        <form action="{{ route('posts.index') }}" method="GET" class="card-glass p-3 p-md-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label-custom"><i class="fas fa-search me-1"></i> Tìm kiếm</label>
                    <input type="text" name="search" class="form-control form-control-dark" placeholder="Tìm bài viết, địa điểm...">
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom"><i class="fas fa-folder me-1"></i> Danh mục</label>
                    <select name="category" class="form-control form-control-dark">
                        <option value="">Tất cả danh mục</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label-custom"><i class="fas fa-map-marker-alt me-1"></i> Địa điểm</label>
                    <input type="text" name="location" class="form-control form-control-dark" placeholder="Đà Nẵng, Hà Nội...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom w-100 py-2">
                        <i class="fas fa-search me-1"></i> Tìm kiếm
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Categories -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center">
            <h2>Khám phá theo <span class="gradient-text">Danh mục</span></h2>
            <p>Chọn chủ đề bạn quan tâm</p>
        </div>
        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-lg-4 col-md-6 animate-fade-in-up delay-{{ $loop->index % 3 * 100 + 100 }}">
                <a href="{{ route('posts.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                    <div class="card-glass text-center p-4" style="cursor: pointer;">
                        <div class="mb-3">
                            <div style="width: 64px; height: 64px; border-radius: 16px; background: var(--gradient-primary); display: inline-flex; align-items: center; justify-content: center;">
                                @php
                                    $icons = ['fas fa-lightbulb', 'fas fa-utensils', 'fas fa-hotel', 'fas fa-map-marked-alt', 'fas fa-magic'];
                                    $icon = $icons[$loop->index % count($icons)];
                                @endphp
                                <i class="{{ $icon }} fa-lg text-white"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">{{ $category->name }}</h5>
                        <p class="text-secondary small mb-2">{{ Str::limit($category->description, 80) }}</p>
                        <span class="badge-category">{{ $category->posts_count }} bài viết</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Posts -->
@if($featuredPosts->count())
<section class="py-5" style="background: rgba(14, 165, 233, 0.03);">
    <div class="container">
        <div class="section-header text-center">
            <h2><i class="fas fa-fire text-warning me-2"></i> Bài viết <span class="gradient-text">Phổ biến</span></h2>
            <p>Những bài viết được đọc nhiều nhất</p>
        </div>
        <div class="row g-4">
            @foreach($featuredPosts as $post)
            @include('components.post-card', ['post' => $post, 'showViews' => true, 'showDate' => true])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Food Section -->
@if($foodPosts->count())
<section class="py-5">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-center">
            <div>
                <h2><i class="fas fa-utensils text-danger me-2"></i> Chuyên mục <span class="gradient-text">Ẩm thực</span></h2>
                <p>Khám phá thế giới ẩm thực phong phú</p>
            </div>
            <a href="{{ route('posts.index', ['category' => 'am-thuc']) }}" class="btn btn-outline-custom">
                Xem tất cả <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($foodPosts as $post)
            @include('components.post-card', ['post' => $post])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Destinations Section -->
@if($destinationPosts->count())
<section class="py-5" style="background: rgba(14, 165, 233, 0.03);">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-center">
            <div>
                <h2><i class="fas fa-map-marked-alt text-success me-2"></i> Chuyên mục <span class="gradient-text">Điểm đến</span></h2>
                <p>Những địa điểm không thể bỏ lỡ</p>
            </div>
            <a href="{{ route('posts.index', ['category' => 'diem-den']) }}" class="btn btn-outline-custom">
                Xem tất cả <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($destinationPosts as $post)
            @include('components.post-card', ['post' => $post])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Check-in / Homestay Section -->
@if($checkinPosts->count())
<section class="py-5">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-center">
            <div>
                <h2><i class="fas fa-hotel text-info me-2"></i> Chuyên mục <span class="gradient-text">Check-in</span></h2>
                <p>Khách sạn, Homestay & Góc sống ảo</p>
            </div>
            <a href="{{ route('posts.index', ['category' => 'checkin']) }}" class="btn btn-outline-custom">
                Xem tất cả <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($checkinPosts as $post)
            @include('components.post-card', ['post' => $post])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="card-glass p-5 text-center" style="background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(16, 185, 129, 0.1));">
            <h2 class="fw-bold mb-3">Bạn có kinh nghiệm du lịch muốn chia sẻ?</h2>
            <p class="text-secondary mb-4 fs-5">Tham gia cộng đồng DuLịchViệt để chia sẻ trải nghiệm và kết nối với những người yêu du lịch!</p>
            @guest
            <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg px-5">
                <i class="fas fa-pen me-2"></i> Đăng ký ngay
            </a>
            @endguest
        </div>
    </div>
</section>
@endsection
