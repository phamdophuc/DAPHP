@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if(auth()->user() && auth()->user()->role === 'admin')
            <div class="card">
                <div class="card-header">
                    <h3>Create Brand</h3>
                </div>
                <div class="card-body">
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

                    <form action="{{ route('brands.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                        <a href="{{ route('brands.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-danger text-center">
                <h4>Unauthorized Access</h4>
                <p>Bạn không có quyền truy cập trang này.</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Quay lại trang chủ</a>
            </div>
        @endif
    </div>
@endsection
