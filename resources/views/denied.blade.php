@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="alert alert-danger" role="alert">
        <h1>Access Denied</h1>
        <p>Bạn không có quyền truy cập vào trang này.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Về trang chủ</a>
    </div>
</div>
@endsection