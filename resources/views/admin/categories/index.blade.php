@extends('layouts.admin')
@section('title', 'Quản lý danh mục')
@section('content')
<div class="admin-header">
    <h2><i class="fas fa-folder me-2" style="color:var(--primary);"></i>Quản lý danh mục</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary-custom"><i class="fas fa-plus me-1"></i>Thêm danh mục</a>
</div>
<div class="table-dark-custom">
    <table class="table"><thead><tr><th>#</th><th>Tên</th><th>Slug</th><th>Mô tả</th><th>Số bài viết</th><th>Hành động</th></tr></thead>
    <tbody>
    @forelse($categories as $cat)
    <tr>
        <td>{{ $cat->id }}</td>
        <td class="fw-bold">{{ $cat->name }}</td>
        <td><code class="text-secondary">{{ $cat->slug }}</code></td>
        <td>{{ Str::limit($cat->description, 50) }}</td>
        <td><span class="badge-status badge-published">{{ $cat->posts_count }}</span></td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Xóa danh mục này?')">@csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr><td colspan="6" class="text-center text-secondary py-4">Không có danh mục nào.</td></tr>
    @endforelse
    </tbody></table>
</div>
<div class="d-flex justify-content-center mt-3">{{ $categories->links() }}</div>
@endsection
