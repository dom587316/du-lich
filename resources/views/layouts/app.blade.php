<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cẩm nang du lịch trực tuyến - Chia sẻ kinh nghiệm và cẩm nang du lịch Việt Nam">
    <title>@yield('title', 'Cẩm Nang Du Lịch') - Du Lịch Việt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --secondary: #06b6d4;
            --accent: #f97316;
            --bg-dark: #ffffff;
            --bg-card: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --gradient-primary: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 50%, #10b981 100%);
            --gradient-hero: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #bae6fd 100%);
            --glass-bg: rgba(255, 255, 255, 1);
            --glass-border: rgba(0, 0, 0, 0.08);
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: 0.75rem 0;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .navbar-brand i {
            color: var(--primary);
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 80%;
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid var(--primary);
            color: var(--primary);
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-custom:hover {
            background: var(--gradient-primary);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
        }

        /* Cards */
        .card-glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow);
        }

        .card-glass:hover {
            transform: translateY(-8px);
            border-color: rgba(14, 165, 233, 0.3);
            box-shadow: 0 15px 35px rgba(14, 165, 233, 0.1);
        }

        .card-glass .card-img-top {
            height: 260px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card-glass:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-glass .card-img-wrapper {
            overflow: hidden;
            position: relative;
        }

        .card-glass .card-img-overlay-gradient {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.6));
        }

        .card-glass .card-body {
            padding: 1.5rem;
        }

        .card-glass .card-title {
            font-weight: 700;
            font-size: 1.2rem;
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }

        .card-glass .card-title a {
            color: var(--text-primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-glass .card-title a:hover {
            color: var(--primary);
        }

        .card-glass .card-text {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Category Badge */
        .badge-category {
            background: rgba(14, 165, 233, 0.2);
            color: var(--primary);
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            border: 1px solid rgba(14, 165, 233, 0.3);
        }

        /* Meta Info */
        .meta-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .meta-info i {
            color: var(--primary);
        }

        /* Rating Stars */
        .stars {
            color: #fbbf24;
        }

        .stars .empty {
            color: var(--text-secondary);
        }

        /* Section Headers */
        .section-header {
            margin-bottom: 2.5rem;
        }

        .section-header h2 {
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .section-header .gradient-text {
            color: var(--primary);
        }

        .section-header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Footer */
        .footer {
            background: #f8fafc;
            border-top: 1px solid var(--glass-border);
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }

        .footer h5 {
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--primary);
        }

        .footer a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s ease;
            display: block;
            padding: 0.25rem 0;
        }

        .footer a:hover {
            color: var(--primary);
        }

        /* Alert */
        .alert-custom {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        .alert-success-custom {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .alert-error-custom {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Pagination */
        .pagination .page-link {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination .page-item.active .page-link {
            background: var(--gradient-primary);
            border-color: transparent;
            color: white !important;
        }

        /* Search */
        .search-box {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .search-box:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .search-box input {
            background: transparent;
            border: none;
            color: var(--text-primary);
            outline: none;
            width: 100%;
        }

        .search-box input::placeholder {
            color: var(--text-secondary);
        }

        /* Form Controls */
        .form-control-dark {
            background: var(--bg-card) !important;
            border: 1px solid var(--glass-border) !important;
            color: var(--text-primary) !important;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control-dark:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1) !important;
        }

        .form-control-dark::placeholder {
            color: var(--text-secondary);
        }

        .form-label-custom {
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        /* Favorite button */
        .btn-favorite {
            border: 2px solid rgba(239, 68, 68, 0.3);
            color: #94a3b8;
            background: transparent;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .btn-favorite.active, .btn-favorite:hover {
            background: rgba(239, 68, 68, 0.15);
            border-color: #ef4444;
            color: #ef4444;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--bg-card);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        /* Mobile */
        @media (max-width: 768px) {
            .section-header h2 {
                font-size: 1.5rem;
            }

            .card-glass .card-img-top {
                height: 180px;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }
        }

        .navbar-toggler {
            border: 1px solid var(--glass-border);
            padding: 0.4rem 0.6rem;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28148, 163, 184, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-compass me-2"></i>DuLịchViệt
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}" href="{{ route('posts.index') }}">
                            <i class="fas fa-newspaper me-1"></i> Bài viết
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-custom btn-sm">
                            <i class="fas fa-sign-in-alt me-1"></i> Đăng nhập
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-sm">
                            <i class="fas fa-user-plus me-1"></i> Đăng ký
                        </a>
                    @else
                        <a href="{{ route('posts.favorites') }}" class="btn btn-sm btn-outline-custom" title="Yêu thích">
                            <i class="fas fa-heart me-1"></i> <span class="d-none d-md-inline">Yêu thích</span>
                        </a>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="user-avatar">
                                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="background: var(--bg-card); border: 1px solid var(--glass-border); box-shadow: var(--shadow);">
                                <li>
                                    <a class="dropdown-item text-dark" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user me-2"></i> Hồ sơ
                                    </a>
                                </li>
                                @if(auth()->user()->isAdmin())
                                <li>
                                    <a class="dropdown-item text-dark" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i> Admin
                                    </a>
                                </li>
                                @endif
                                <li><hr class="dropdown-divider" style="border-color: var(--glass-border);"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-dark">
                                            <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main style="padding-top: 76px;">
        @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-custom alert-success-custom alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-custom alert-error-custom alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5><i class="fas fa-compass me-2"></i>DuLịchViệt</h5>
                    <p class="text-secondary">Cẩm nang du lịch trực tuyến - Nơi chia sẻ kinh nghiệm và cảm hứng du lịch Việt Nam.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-secondary fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-secondary fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-secondary fs-5"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-secondary fs-5"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5>Khám phá</h5>
                    <a href="{{ route('posts.index') }}">Tất cả bài viết</a>
                    <a href="{{ route('posts.index', ['sort' => 'popular']) }}">Phổ biến</a>
                    <a href="{{ route('posts.index', ['sort' => 'latest']) }}">Mới nhất</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Danh mục</h5>
                    @php $footerCategories = \App\Models\Category::take(5)->get(); @endphp
                    @foreach($footerCategories as $cat)
                    <a href="{{ route('posts.index', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Liên hệ</h5>
                    <p class="text-secondary mb-1"><i class="fas fa-envelope me-2"></i>contact@dulichviet.com</p>
                    <p class="text-secondary mb-1"><i class="fas fa-phone me-2"></i>0123 456 789</p>
                    <p class="text-secondary"><i class="fas fa-map-marker-alt me-2"></i>Việt Nam</p>
                </div>
            </div>
            <hr style="border-color: var(--glass-border); margin: 2rem 0 1rem;">
            <div class="text-center text-secondary">
                <small>&copy; {{ date('Y') }} DuLịchViệt. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Auto-dismiss alerts
        setTimeout(function() {
            document.querySelectorAll('.alert-dismissible').forEach(function(alert) {
                new bootstrap.Alert(alert).close();
            });
        }, 5000);
    </script>
    @stack('scripts')
</body>
</html>
