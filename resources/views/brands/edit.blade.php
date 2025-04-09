@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<style>
    .container {
        max-width: 600px;
        margin: 60px auto;
        padding: 40px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    h1 {
        text-align: center;
        font-size: 30px;
        color: #6b46c1;
        margin-bottom: 30px;
        font-weight: 700;
    }

    label {
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }

    .form-control {
        padding: 12px 16px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
        background: #fafafa;
    }

    .form-control:focus {
        border-color: #6b46c1;
        box-shadow: 0 0 5px rgba(107, 70, 193, 0.4);
        outline: none;
    }

    .btn-submit, .btn-back {
        padding: 12px;
        font-size: 17px;
        border: none;
        border-radius: 8px;
        width: 100%;
        margin-top: 20px;
        cursor: pointer;
        transition: background 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-weight: 500;
    }

    .btn-submit {
        background: #6b46c1;
        color: white;
    }

    .btn-submit:hover {
        background: #5532a2;
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-back:hover {
        background: #5a6268;
    }
</style>

<div class="container">
    <h1>{{ isset($brand) ? 'Chỉnh sửa Thương hiệu' : 'Thêm Thương hiệu' }}</h1>
    <form action="{{ isset($brand) ? route('brands.update', $brand->id) : route('brands.store') }}" method="POST">
        @csrf
        @if(isset($brand)) @method('PUT') @endif
        <div class="form-group mb-3">
            <label for="name">Tên thương hiệu</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $brand->name ?? '') }}" required>
        </div>
        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> {{ isset($brand) ? 'Cập nhật' : 'Tạo mới' }}
        </button>
        <a href="{{ route('brands.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </form>
</div>
@endsection
