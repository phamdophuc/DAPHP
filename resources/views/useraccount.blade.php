@extends('layouts.app')

<style>
    body {
        background-color: #f4f4f9;
    }

    .user-title {
        text-align: center;
        margin-top: 40px;
        font-size: 32px;
        font-weight: bold;
        color: #6b46c1;
    }
    .container {
        width: 95%;
        max-width: 1200px;
        margin: 40px auto;
        padding: 5px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .user-filter-form {
        margin: 30px auto;
        padding: 24px;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(107, 70, 193, 0.15);
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 16px;
        max-width: 1000px;
    }

    .user-filter-form .form-control {
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        width: 200px;
        font-size: 14px;
        transition: border-color 0.2s;
    }

    .user-filter-form .form-control:focus {
        border-color: #6b46c1;
        outline: none;
        box-shadow: 0 0 5px rgba(107, 70, 193, 0.3);
    }

    .btn-filter,
    .btn-reset {
        padding: 10px 22px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-filter {
        background: linear-gradient(to right, #6b46c1, #9f7aea);
        color: white;
        box-shadow: 0 4px 12px rgba(107, 70, 193, 0.25);
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(107, 70, 193, 0.35);
    }

    .btn-reset {
        background-color: #e2e8f0;
        color: #4a5568;
    }

    .btn-reset:hover {
        background-color: #cbd5e0;
    }

    .table-container {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
        margin: 30px auto;
        padding: 24px;
        max-width: 1500px;
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
    }

    .user-table th,
    .user-table td {
        padding: 14px 16px;
        text-align: center;
        font-size: 15px;
        border-bottom: 1px solid #e2e8f0;
    }

    .user-table th {
        background-color: #f4f4f9;
        color: #4a4a4a;
        font-weight: 600;
    }

    .user-table tbody tr:hover {
        background-color: #f9f7fd;
    }

    @media (max-width: 768px) {
        .user-filter-form {
            flex-direction: column;
            align-items: center;
        }

        .user-filter-form .form-control {
            width: 100%;
            max-width: 90%;
        }

        .btn-filter,
        .btn-reset {
            width: 150px;
            text-align: center;
        }
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
