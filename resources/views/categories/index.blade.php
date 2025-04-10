@extends('layouts.app')
<style>
    /* Basic Container Styling */
.container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    font-size: 32px;
    color: #333;
    margin-bottom: 30px;
}

/* Button Styling */
.btn-primary, .btn-warning, .btn-danger {
    font-size: 16px;
    border-radius: 6px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-primary {
    background-color: #007bff;
    color: white;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-warning {
    background-color: #ffc107;
    color: white;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Table Styling */
.table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
}

.table th, .table td {
    text-align: center;
    padding: 15px;
    border: 1px solid #ddd;
}

.table th {
    background-color: #f8f9fa;
    font-size: 18px;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .container {
        padding: 20px;
        margin: 20px;
    }

    h1 {
        font-size: 28px;
    }

    .table th, .table td {
        padding: 10px;
        font-size: 14px;
    }

    .btn-primary, .btn-warning, .btn-danger {
        font-size: 14px;
        padding: 8px 16px;
    }
}
</style>
@section('content')
    <div class="container">
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
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
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
