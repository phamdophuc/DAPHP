@extends('layouts.app')

@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    $hotStartDate = $product->hot_start_date ? Carbon::parse($product->hot_start_date)->setTimezone('Asia/Ho_Chi_Minh') : null;
    $hotEndDate = $product->hot_end_date ? Carbon::parse($product->hot_end_date)->setTimezone('Asia/Ho_Chi_Minh') : null;
@endphp

@push('styles')
    <style>
        /* Basic Container Styling */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .container:hover {
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: 700;
            color: #6b46c1;
            text-transform: uppercase;
        }

        /* Error Message Styling */
        .alert {
            margin-top: 20px;
            font-size: 16px;
            padding: 15px;
            background-color: #fbdada;
            border-radius: 8px;
            color: #9b2c2c;
            border: 1px solid #f6d1d1;
        }

        .alert ul {
            padding-left: 20px;
            list-style-type: none;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #4a4a4a;
        }

        .form-control {
            width: 100%;
            padding: 12px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f7fafc;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #6b46c1;
            box-shadow: 0 0 8px rgba(107, 70, 193, 0.5);
        }

        .form-control[type="file"] {
            padding: 10px;
            font-size: 14px;
            background-color: #fff;
        }

        /* Row Layout for Two Inputs */
        .row {
            display: flex;
            gap: 20px;
        }

        .col-md-6 {
            flex: 1;
        }

        /* Button Styling */
        .btn-success, .btn-secondary {
            width: 100%;
            padding: 14px;
            font-size: 18px;
            background-color: #6b46c1;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-success:hover {
            background-color: #5a34a3;
        }

        .btn-secondary {
            background-color: #6c757d;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Image Thumbnail */
        .img-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 10px;
        }

        /* Textarea Styling */
        textarea.form-control {
            min-height: 120px;
        }

        select.form-control, input.form-control {
            margin-bottom: 10px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h1>Chỉnh Sửa Sản Phẩm</h1>
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên Sản Phẩm</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Giá (VNĐ)</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discount">Giảm Giá (%)</label>
                        <input type="number" step="0.01" name="discount" class="form-control" value="{{ old('discount') }}">
                        <small class="form-text text-muted">Nếu có giảm giá, nhập tỷ lệ phần trăm.</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image_url">Ảnh Sản Phẩm</label>
                <input type="text" name="image_url" class="form-control">
                @if ($product->image_url)
                    <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="img-thumbnail">
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id">Danh Mục</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="brand_id">Thương Hiệu</label>
                        <select name="brand_id" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="quantity">Số Lượng</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Trạng Thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $product->status ? 'selected' : '' }}>Kích Hoạt</option>
                    <option value="0" {{ !$product->status ? 'selected' : '' }}>Không Kích Hoạt</option>
                </select>
            </div>

            <div class="form-group">
                <label for="is_hot">Sản Phẩm Hot</label>
                <select name="is_hot" class="form-control">
                    <option value="1" {{ $product->is_hot ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ !$product->is_hot ? 'selected' : '' }}>Không</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hot_start_date">Ngày Bắt Đầu Hot</label>
                        <input type="datetime-local" name="hot_start_date" class="form-control"
                            value="{{ old('hot_start_date', $hotStartDate ? $hotStartDate->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hot_end_date">Ngày Kết Thúc Hot</label>
                        <input type="datetime-local" name="hot_end_date" class="form-control"
                            value="{{ old('hot_end_date', $hotEndDate ? $hotEndDate->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Cập Nhật</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
@endsection
