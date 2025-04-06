@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp


<style>
    /* Basic Container Styles */
.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
    color: #333;
}

/* Error Message Styling */
.alert {
    margin-top: 20px;
    font-size: 16px;
    padding: 15px;
    background-color: #f8d7da;
    border-radius: 5px;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert ul {
    padding-left: 20px;
    list-style-type: none;
}

/* Form Styling */
.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
    color: #444;
}

.form-control {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    background-color: #fdfdfd;
}

.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 4px rgba(40, 167, 69, 0.5);
}

/* Button Styles */
.btn-success {
    width: 100%;
    padding: 12px;
    font-size: 18px;
    background-color: #28a745;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-success:hover {
    background-color: #218838;
}

/* File Input Styles */
.form-control[type="file"] {
    padding: 8px;
    font-size: 14px;
}

/* Textarea Styles */
textarea.form-control {
    min-height: 120px;
}

/* Select and Input Field Styling */
select.form-control, input.form-control {
    margin-bottom: 10px;
}

/* Add some space between the form elements */
.form-group:last-child {
    margin-bottom: 0;
}
</style>
@section('content')
    <div class="container">
        <h1>Add Product</h1>
        
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

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="discount">Discount (%)</label>
                <input type="number" step="0.01" name="discount" class="form-control" value="{{ old('discount') }}">
                <small class="form-text text-muted">Nếu có giảm giá, nhập tỷ lệ phần trăm.</small>
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
                <input type="text" name="image_url" class="form-control" placeholder="Nhập URL hình ảnh" value="{{ old('image_url', isset($product) ? $product->image_url : '') }}" required>
                @if (isset($product) && $product->image_url)
                    <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
