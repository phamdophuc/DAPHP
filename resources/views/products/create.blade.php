@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Product</h1>

        @if (Auth::check() && Auth::user()->role === 'admin')
            {{-- Hiển thị lỗi nếu có --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                </div>

                <div class="form-group">
                    <label for="promotion_price">Promotion Price</label>
                    <input type="number" step="0.01" name="promotion_price" class="form-control" value="{{ old('promotion_price') }}">
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" class="form-control">
                        <option value="">-- Select Brand --</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="is_hot">Hot Product</label>
                    <select name="is_hot" class="form-control">
                        <option value="0" {{ old('is_hot') == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('is_hot') == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="hot_start_date">Hot Start Date</label>
                    <input type="datetime-local" name="hot_start_date" class="form-control" value="{{ old('hot_start_date') }}">
                </div>

                <div class="form-group">
                    <label for="hot_end_date">Hot End Date</label>
                    <input type="datetime-local" name="hot_end_date" class="form-control" value="{{ old('hot_end_date') }}">
                </div>

                <div class="form-group">
                    <label for="image_url">Product Image</label>
                    <input type="file" name="image_url" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            </form>
        @else
            <div class="alert alert-danger">
                <h4>Unauthorized Access</h4>
                <p>Bạn không có quyền truy cập trang này.</p>
            </div>
        @endif
    </div>
@endsection
