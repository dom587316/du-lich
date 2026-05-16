@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<section class="py-5" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card-glass p-4 p-md-5 animate-fade-in-up">
                    <div class="text-center mb-4">
                        <div style="width: 70px; height: 70px; border-radius: 20px; background: var(--gradient-primary); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <i class="fas fa-user-plus fa-2x text-white"></i>
                        </div>
                        <h3 class="fw-bold">Đăng ký tài khoản</h3>
                        <p class="text-secondary">Tham gia cộng đồng du lịch!</p>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-custom alert-error-custom mb-3">
                        @foreach($errors->all() as $error)
                        <div><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-custom">Họ và tên</label>
                            <input type="text" name="name" class="form-control form-control-dark" placeholder="Nguyễn Văn A" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Email</label>
                            <input type="email" name="email" class="form-control form-control-dark" placeholder="your@email.com" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Mật khẩu</label>
                            <input type="password" name="password" class="form-control form-control-dark" placeholder="Ít nhất 8 ký tự" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label-custom">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-dark" placeholder="Nhập lại mật khẩu" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 py-2 mb-3">
                            <i class="fas fa-user-plus me-2"></i> Đăng ký
                        </button>
                    </form>
                    <p class="text-center text-secondary mb-0">
                        Đã có tài khoản? <a href="{{ route('login') }}" style="color: var(--primary);">Đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
