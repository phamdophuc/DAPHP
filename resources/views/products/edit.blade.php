@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>

        @if (Auth::check() && Auth::user()->role === 'admin')
            {{-- Hiển thị lỗi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Tên sản phẩm --}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>

                {{-- Giá & Giá khuyến mãi --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" 
                                   value="{{ old('price', $product->price) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="promotion_price">Promotion Price</label>
                            <input type="number" step="0.01" name="promotion_price" class="form-control" 
                                   value="{{ old('promotion_price', $product->promotion_price) }}">
                        </div>
                    </div>
                </div>

                {{-- Mô tả sản phẩm --}}
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Hình ảnh --}}
                <div class="form-group">
                    <label for="image_url">Product Image</label>
                    <input type="file" name="image_url" class="form-control">
                    @if ($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                {{-- Danh mục & Thương hiệu --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">Category</label>
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
                            <label for="brand_id">Brand</label>
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

                {{-- Số lượng --}}
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
                </div>

                {{-- Trạng thái --}}
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Hot Product --}}
                <div class="form-group">
                    <label for="is_hot">Is Hot?</label>
                    <select name="is_hot" class="form-control">
                        <option value="1" {{ $product->is_hot ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$product->is_hot ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                {{-- Ngày bắt đầu & kết thúc hot --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hot_start_date">Hot Start Date</label>
                            <input type="datetime-local" name="hot_start_date" class="form-control"
                                   value="{{ old('hot_start_date', $product->hot_start_date ? date('Y-m-d\TH:i', strtotime($product->hot_start_date)) : '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hot_end_date">Hot End Date</label>
                            <input type="datetime-local" name="hot_end_date" class="form-control"
                                   value="{{ old('hot_end_date', $product->hot_end_date ? date('Y-m-d\TH:i', strtotime($product->hot_end_date)) : '') }}">
                        </div>
                    </div>
                </div>

                {{-- SEO --}}
                <div class="form-group">
                    <label for="seo_title">SEO Title</label>
                    <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $product->seo_title ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword', $product->meta_keyword ?? '') }}">
                </div>

                {{-- Nút thao tác --}}
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
            </form>
        @else
            <div class="alert alert-danger">
                <h4>Unauthorized Access</h4>
                <p>Bạn không có quyền chỉnh sửa sản phẩm.</p>
            </div>
        @endif
    </div>
@endsection
