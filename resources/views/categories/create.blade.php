@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="card">
                <div class="card-header">
                    <h3>Create Category</h3>
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

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
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
