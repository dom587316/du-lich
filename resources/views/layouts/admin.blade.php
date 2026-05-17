<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--primary:#0ea5e9;--bg-dark:#f8fafc;--bg-card:#ffffff;--bg-sidebar:#ffffff;--text-primary:#0f172a;--text-secondary:#64748b;--glass-border:rgba(0,0,0,0.1);--gradient-primary:linear-gradient(135deg,#0ea5e9 0%,#06b6d4 50%,#10b981 100%);}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Inter',sans-serif;background:var(--bg-dark);color:var(--text-primary);min-height:100vh;}
        .admin-sidebar{width:260px;background:var(--bg-sidebar);min-height:100vh;position:fixed;left:0;top:0;border-right:1px solid var(--glass-border);z-index:100;transition:transform 0.3s;}
        .admin-sidebar .brand{padding:1.5rem;border-bottom:1px solid var(--glass-border);}
        .admin-sidebar .brand h4{font-weight:800;background:var(--gradient-primary);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
        .admin-sidebar .nav-link{color:var(--text-secondary);padding:0.75rem 1.5rem;transition:all 0.3s;border-left:3px solid transparent;}
        .admin-sidebar .nav-link:hover,.admin-sidebar .nav-link.active{color:var(--primary);background:rgba(14,165,233,0.1);border-left-color:var(--primary);}
        .admin-sidebar .nav-link i{width:24px;text-align:center;margin-right:10px;}
        .admin-content{margin-left:260px;padding:2rem;min-height:100vh;}
        .admin-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
        .admin-header h2{font-weight:800;margin:0;}
        .stat-card{background:var(--bg-card);border:1px solid var(--glass-border);border-radius:16px;padding:1.5rem;transition:all 0.3s;}
        .stat-card:hover{border-color:rgba(14,165,233,0.3);transform:translateY(-3px);}
        .stat-card .stat-icon{width:50px;height:50px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;}
        .stat-card .stat-value{font-size:1.8rem;font-weight:800;}
        .stat-card .stat-label{color:var(--text-secondary);font-size:0.85rem;}
        .table-dark-custom{background:var(--bg-card);border-radius:12px;overflow:hidden;border:1px solid var(--glass-border);}
        .table-dark-custom table{margin:0;color:var(--text-primary);}
        .table-dark-custom th{background:rgba(14,165,233,0.1);border-bottom:1px solid var(--glass-border);font-weight:600;font-size:0.85rem;color:var(--text-secondary);padding:0.75rem 1rem;}
        .table-dark-custom td{border-bottom:1px solid var(--glass-border);padding:0.75rem 1rem;vertical-align:middle;font-size:0.9rem;}
        .table-dark-custom tr:hover td{background:rgba(14,165,233,0.05);}
        .btn-primary-custom{background:var(--gradient-primary);border:none;color:white;font-weight:600;padding:0.5rem 1.5rem;border-radius:50px;transition:all 0.3s;}
        .btn-primary-custom:hover{transform:translateY(-2px);box-shadow:0 10px 25px rgba(14,165,233,0.3);color:white;}
        .form-control-dark{background:var(--bg-card)!important;border:1px solid var(--glass-border)!important;color:var(--text-primary)!important;border-radius:12px;padding:0.75rem 1rem;}
        .form-control-dark:focus{border-color:var(--primary)!important;box-shadow:0 0 0 3px rgba(14,165,233,0.1)!important;}
        .card-glass{background:var(--bg-card);border:1px solid var(--glass-border);border-radius:16px;overflow:hidden;}
        .badge-status{padding:0.35rem 0.75rem;border-radius:50px;font-weight:600;font-size:0.75rem;}
        .badge-published{background:rgba(16,185,129,0.2);color:#10b981;}
        .badge-draft{background:rgba(234,179,8,0.2);color:#eab308;}
        .badge-admin{background:rgba(139,92,246,0.2);color:#8b5cf6;}
        .badge-user{background:rgba(14,165,233,0.2);color:#0ea5e9;}
        .alert-custom{border:none;border-radius:12px;padding:1rem 1.5rem;font-weight:500;}
        .alert-success-custom{background:rgba(16,185,129,0.15);color:#10b981;border:1px solid rgba(16,185,129,0.3);}
        .alert-error-custom{background:rgba(239,68,68,0.15);color:#ef4444;border:1px solid rgba(239,68,68,0.3);}
        .pagination .page-link{background:var(--bg-card);border:1px solid var(--glass-border);color:var(--text-secondary);}
        .pagination .page-item.active .page-link{background:var(--gradient-primary);border-color:transparent;}
        @media(max-width:768px){.admin-sidebar{transform:translateX(-100%);}.admin-sidebar.show{transform:translateX(0);}.admin-content{margin-left:0;}}
    </style>
    @stack('styles')
</head>
<body>
    <aside class="admin-sidebar" id="sidebar">
        <div class="brand"><h4><i class="fas fa-compass me-2"></i>Admin Panel</h4><small class="text-secondary">Cẩm nang Du lịch</small></div>
        <nav class="mt-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i>Bài viết</a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="fas fa-folder"></i>Danh mục</a>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="fas fa-users"></i>Người dùng</a>
            <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}"><i class="fas fa-comments"></i>Bình luận</a>
            <hr style="border-color:var(--glass-border);margin:1rem 1.5rem;">
            <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-globe"></i>Về trang chủ</a>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start" style="color:var(--text-secondary);"><i class="fas fa-sign-out-alt"></i>Đăng xuất</button>
            </form>
        </nav>
    </aside>
    <main class="admin-content">
        <button class="btn btn-sm btn-outline-secondary d-md-none mb-3" onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="fas fa-bars"></i>
        </button>
        @if(session('success'))
        <div class="alert alert-custom alert-success-custom alert-dismissible fade show mb-3"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-custom alert-error-custom alert-dismissible fade show mb-3"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
