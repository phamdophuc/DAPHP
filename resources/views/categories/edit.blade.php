@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if(auth()->user() && auth()->user()->role === 'admin')
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category</h3>
                </div>
                <div class="card-body">
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

                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-danger text-center">
                <h4>Unauthorized Access</h4>
                <p>You do not have permission to access this page.</p>
            </div>
        @endif
    </div>
@endsection
