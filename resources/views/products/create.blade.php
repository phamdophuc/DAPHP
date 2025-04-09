@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@push('styles')
<style>
        /* Container Style */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .container:hover {
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #6b46c1;
            font-weight: 700;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Alert Styling */
        .alert {
            margin-top: 20px;
            font-size: 14px;
            padding: 16px;
            background-color: #fbdada;
            border-radius: 8px;
            color: #9b2c2c;
            border: 1px solid #f6d1d1;
        }

        .alert ul {
            padding-left: 20px;
            list-style-type: none;
        }

        /* Input & Select Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border-radius: 10px;
            border: 2px solid #ddd;
            font-size: 16px;
            background-color: #f7fafc;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #6b46c1;         
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.5);
        }

        /* Button Styling */
        .btn-success {
            width: 100%;
            padding: 14px;
            font-size: 18px;
            background-color: #6b46c1;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #6b46c1;
        }

        /* File Input Styling */
        .form-control[type="file"] {
            padding: 10px;
            font-size: 14px;
            background-color: #fff;
        }

        /* Textarea Styling */
        textarea.form-control {
            min-height: 150px;
        }

        /* Select and Input Field Styling */
        select.form-control,
        input.form-control {
            margin-bottom: 12px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        /* Image Preview */
        .img-thumbnail {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 10px;
            border: 2px solid #ddd;
        }

        /* Input Styling for Number and Price */
        .form-control[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }

        .form-control[type="number"]::-webkit-outer-spin-button,
        .form-control[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>
@endpush

@section('content')
    <div class="container">
        <h1>Thêm Sản Phẩm</h1>
        
        {{-- Hiển thị lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Tên Sản Phẩm</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="price">Giá (VNĐ)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="discount">Giảm Giá (%)</label>
                <input type="number" step="0.01" name="discount" class="form-control" value="{{ old('discount') }}">
                <small class="form-text text-muted">Nếu có giảm giá, nhập tỷ lệ phần trăm.</small>
            </div>

            <div class="form-group">
                <label for="quantity">Số Lượng</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Danh Mục</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Chọn Danh Mục --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="brand_id">Thương Hiệu</label>
                <select name="brand_id" class="form-control">
                    <option value="">-- Chọn Thương Hiệu --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Trạng Thái</label>
                <select name="status" class="form-control" required>
                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Kích Hoạt</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không Kích Hoạt</option>
                </select>
            </div>

            <div class="form-group">
                <label for="is_hot">Sản Phẩm Hot</label>
                <select name="is_hot" class="form-control">
                    <option value="0" {{ old('is_hot') == 0 ? 'selected' : '' }}>Không</option>
                    <option value="1" {{ old('is_hot') == 1 ? 'selected' : '' }}>Có</option>
                </select>
            </div>

            <div class="form-group">
                <label for="hot_start_date">Ngày Bắt Đầu Hot</label>
                <input type="datetime-local" name="hot_start_date" class="form-control" value="{{ old('hot_start_date') }}">
            </div>

            <div class="form-group">
                <label for="hot_end_date">Ngày Kết Thúc Hot</label>
                <input type="datetime-local" name="hot_end_date" class="form-control" value="{{ old('hot_end_date') }}">
            </div>

            <div class="form-group">
                <label for="image_url">Ảnh Sản Phẩm</label>
                <input type="text" name="image_url" class="form-control" placeholder="Nhập URL hình ảnh" value="{{ old('image_url', isset($product) ? $product->image_url : '') }}" required>
                @if (isset($product) && $product->image_url)
                    <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="img-thumbnail">
                @endif
            </div>

            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div>
@endsection
