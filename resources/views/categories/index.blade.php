@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    .container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        font-size: 36px;
        color: #6b46c1;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .btn-add {
        background-color: #6b46c1;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(107, 70, 193, 0.3);
    }

    .btn-add:hover {
        background-color: #5531a7;
        transform: translateY(-2px);
    }

    .table {
        width: 100%;
        margin-top: 30px;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th, .table td {
        text-align: center;
        padding: 16px;
        border-bottom: 1px solid #eee;
    }

    .table th {
        background-color: #f4f2fb;
        color: #6b46c1;
        font-size: 18px;
        font-weight: 600;
    }

    .table tbody tr:hover {
        background-color: #faf8ff;
    }

    .icon-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        margin: 0 5px;
        color: #6b46c1;
        transition: color 0.2s ease, transform 0.2s;
    }

    .icon-btn:hover {
        color: #5531a7;
        transform: scale(1.1);
    }
</style>

<div class="container">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn-add"><i class="fas fa-plus"></i> Add Category</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="icon-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="icon-btn" title="Delete" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
