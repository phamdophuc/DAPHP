@extends('layouts.app')

<style>
    .user-title {
        text-align: center;
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 28px;
        font-weight: bold;
        color: #007bff;
    }

    .table-container {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .user-table th, .user-table td {
        border: 1px solid #dee2e6;
        padding: 12px 15px;
        text-align: center;
        font-size: 14px;
    }

    .user-table th {
        background-color: #f1f1f1;
        color: #333;
    }

    .user-table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .user-filter-form {
        margin: 30px 0;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    .user-filter-form .form-control {
        padding: 8px 12px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        width: 200px;
        font-size: 14px;
    }

    .user-filter-form .btn-filter, .user-filter-form .btn-reset {
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        border: none;
    }

    .btn-filter {
        background-color: #007bff;
        color: white;
    }

    .btn-filter:hover {
        background-color: #0056b3;
    }

    .btn-reset {
        background-color: #6c757d;
        color: white;
    }

    .btn-reset:hover {
        background-color: #5a6268;
    }
</style>

@section('content')

<div class="container">

    <div class="user-title">Danh sách người dùng</div>

    <form method="GET" action="{{ route('users.index') }}" class="user-filter-form">
        <input type="text" name="id" placeholder="Order ID" value="{{ request('id') }}" class="form-control">
        <input type="text" name="user_id" placeholder="User ID" value="{{ request('user_id') }}" class="form-control">
        <input type="text" name="email" placeholder="Email người dùng" value="{{ request('email') }}" class="form-control">

        <select name="month" class="form-control">
            <option value="">-- Tháng tạo --</option>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>Tháng {{ $m }}</option>
            @endfor
        </select>

        <button type="submit" class="btn-filter">Tìm kiếm</button>
        <a href="{{ route('users.index') }}" class="btn-reset">Reset</a>
    </form>

    <div class="table-container">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name ?? 'Không có tên' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
