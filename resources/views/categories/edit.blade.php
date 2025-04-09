@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        font-size: 32px;
        color: #6b46c1;
        margin-bottom: 30px;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        color: #333;
        font-weight: 500;
    }

    input[type="text"] {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
        box-sizing: border-box;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="text"]:focus {
        border-color: #6b46c1;
        box-shadow: 0 0 0 3px rgba(107, 70, 193, 0.2);
        outline: none;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
    }

    .icon-btn {
        background-color: #6b46c1;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        font-size: 16px;
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .icon-btn:hover {
        background-color: #5531a7;
    }

    .btn-secondary {
        background-color: #e2e2e2;
        color: #333;
    }

    .btn-secondary:hover {
        background-color: #d0d0d0;
    }
</style>

<div class="container">
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="btn-group">
            <button type="submit" class="icon-btn"><i class="fas fa-save"></i> Update</button>
            <a href="{{ route('categories.index') }}" class="icon-btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </form>
</div>
@endsection
