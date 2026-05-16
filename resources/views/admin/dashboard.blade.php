@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="admin-header">
    <h2><i class="fas fa-tachometer-alt me-2" style="color:var(--primary);"></i>Dashboard</h2>
    <span class="text-secondary">{{ now()->format('d/m/Y') }}</span>
</div>
<div class="row g-4 mb-4">
    <div class="col-lg-2 col-md-4 col-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(14,165,233,0.15);color:#0ea5e9;"><i class="fas fa-newspaper"></i></div>
                <div><div class="stat-value">{{ $stats['total_posts'] }}</div><div class="stat-label">Bài viết</div></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(16,185,129,0.15);color:#10b981;"><i class="fas fa-check-circle"></i></div>
                <div><div class="stat-value">{{ $stats['published_posts'] }}</div><div class="stat-label">Đã đăng</div></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(139,92,246,0.15);color:#8b5cf6;"><i class="fas fa-users"></i></div>
                <div><div class="stat-value">{{ $stats['total_users'] }}</div><div class="stat-label">Người dùng</div></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(249,115,22,0.15);color:#f97316;"><i class="fas fa-comments"></i></div>
                <div><div class="stat-value">{{ $stats['total_comments'] }}</div><div class="stat-label">Bình luận</div></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,0.15);color:#eab308;"><i class="fas fa-eye"></i></div>
                <div><div class="stat-value">{{ number_format($stats['total_views']) }}</div><div class="stat-label">Lượt xem</div></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(239,68,68,0.15);color:#ef4444;"><i class="fas fa-clock"></i></div>
                <div><div class="stat-value">{{ $stats['pending_comments'] }}</div><div class="stat-label">Chờ duyệt</div></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card-glass p-4">
            <h5 class="fw-bold mb-3"><i class="fas fa-chart-bar me-2" style="color:var(--primary);"></i>Bài viết theo tháng</h5>
            <canvas id="postsChart" height="250"></canvas>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-glass p-4">
            <h5 class="fw-bold mb-3"><i class="fas fa-chart-pie me-2" style="color:var(--primary);"></i>Lượt xem theo danh mục</h5>
            <canvas id="viewsChart" height="250"></canvas>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card-glass p-4">
            <h5 class="fw-bold mb-3"><i class="fas fa-newspaper me-2" style="color:var(--primary);"></i>Bài viết gần đây</h5>
            @foreach($recentPosts as $post)
            <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid var(--glass-border);">
                <div>
                    <div class="fw-bold" style="font-size:0.9rem;">{{ Str::limit($post->title, 40) }}</div>
                    <small class="text-secondary">{{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}</small>
                </div>
                <span class="badge-status {{ $post->status === 'published' ? 'badge-published' : 'badge-draft' }}">{{ $post->status === 'published' ? 'Đã đăng' : 'Nháp' }}</span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-glass p-4">
            <h5 class="fw-bold mb-3"><i class="fas fa-comments me-2" style="color:var(--primary);"></i>Bình luận gần đây</h5>
            @foreach($recentComments as $comment)
            <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid var(--glass-border);">
                <div>
                    <div style="font-size:0.9rem;">{{ Str::limit($comment->content, 50) }}</div>
                    <small class="text-secondary">{{ $comment->user->name }} · {{ $comment->post->title ?? 'N/A' }}</small>
                </div>
                <span class="badge-status {{ $comment->is_approved ? 'badge-published' : 'badge-draft' }}">{{ $comment->is_approved ? 'Đã duyệt' : 'Chờ duyệt' }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const months = {!! json_encode($postsPerMonth->pluck('month')) !!};
const counts = {!! json_encode($postsPerMonth->pluck('count')) !!};
const monthNames = ['','Th1','Th2','Th3','Th4','Th5','Th6','Th7','Th8','Th9','Th10','Th11','Th12'];
new Chart(document.getElementById('postsChart'),{type:'bar',data:{labels:months.map(m=>monthNames[m]),datasets:[{label:'Bài viết',data:counts,backgroundColor:'rgba(14,165,233,0.5)',borderColor:'#0ea5e9',borderWidth:2,borderRadius:8}]},options:{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,ticks:{color:'#94a3b8'},grid:{color:'rgba(148,163,184,0.1)'}},x:{ticks:{color:'#94a3b8'},grid:{display:false}}}}});

const catNames = {!! json_encode($viewsPerCategory->pluck('name')) !!};
const catViews = {!! json_encode($viewsPerCategory->pluck('views')) !!};
const colors = ['#0ea5e9','#06b6d4','#10b981','#f97316','#8b5cf6','#ef4444'];
new Chart(document.getElementById('viewsChart'),{type:'doughnut',data:{labels:catNames,datasets:[{data:catViews,backgroundColor:colors.slice(0,catNames.length),borderWidth:0}]},options:{responsive:true,plugins:{legend:{position:'bottom',labels:{color:'#94a3b8',padding:15}}}}});
</script>
@endpush
@endsection
