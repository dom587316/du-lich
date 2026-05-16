@extends('layouts.app')
@section('title', 'Hồ sơ cá nhân')
@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card-glass p-4 text-center">
                    <img src="{{ $user->avatar_url }}" alt="" class="rounded-circle mb-3" style="width:120px;height:120px;object-fit:cover;border:3px solid var(--primary);">
                    <h4 class="fw-bold">{{ $user->name }}</h4>
                    <p class="text-secondary">{{ $user->email }}</p>
                    <span class="badge-category">{{ $user->role === 'admin' ? 'Quản trị viên' : 'Thành viên' }}</span>
                    <hr style="border-color:var(--glass-border);">
                    <div class="d-flex justify-content-around">
                        <div><div class="fw-bold fs-4" style="color:var(--primary);">{{ $user->posts->count() }}</div><small class="text-secondary">Bài viết</small></div>
                        <div><div class="fw-bold fs-4" style="color:var(--secondary);">{{ $user->comments->count() }}</div><small class="text-secondary">Bình luận</small></div>
                        <div><div class="fw-bold fs-4" style="color:var(--accent);">{{ $user->favorites->count() }}</div><small class="text-secondary">Yêu thích</small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-glass p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-edit me-2" style="color:var(--primary);"></i>Cập nhật thông tin</h5>
                    @if($errors->any())
                    <div class="alert alert-custom alert-error-custom mb-3">
                        @foreach($errors->all() as $e)<div><i class="fas fa-exclamation-circle me-1"></i>{{ $e }}</div>@endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">@csrf @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Họ tên</label>
                                <input type="text" name="name" class="form-control form-control-dark" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Email</label>
                                <input type="email" name="email" class="form-control form-control-dark" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label-custom">Avatar</label>
                                <input type="file" name="avatar" class="form-control form-control-dark" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Mật khẩu mới (để trống nếu không đổi)</label>
                                <input type="password" name="password" class="form-control form-control-dark">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Xác nhận mật khẩu</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-dark">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-1"></i>Lưu thay đổi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
