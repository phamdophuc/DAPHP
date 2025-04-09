@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-4xl font-bold text-[#6b46c1]">Danh sách Đơn Hàng</h1>

    @if (Gate::allows('admin'))
        <form action="{{ route('orders.index') }}" method="GET" class="d-flex mb-4 flex-wrap justify-content-center">
            <input type="text" name="order_id" class="form-control custom-input me-3 mb-2" placeholder="Mã Đơn Hàng" value="{{ request('order_id') }}">
            <input type="text" name="user_id" class="form-control custom-input me-3 mb-2" placeholder="User ID" value="{{ request('user_id') }}">
            <input type="text" name="email" class="form-control custom-input me-3 mb-2" placeholder="Email người dùng" value="{{ request('email') }}">

            <button type="submit" class="btn btn-primary custom-btn mb-2">Tìm kiếm</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary custom-btn mb-2">Reset</a>
        </form>
    @endif

    <!-- Table displaying orders -->
    <div class="table-responsive">
        <table class="table table-bordered mx-auto">
            <thead class="bg-[#6b46c1] text-white">
                <tr>
                    <th>ID</th>
                    @if (Gate::allows('admin'))
                        <th>User ID</th>
                        <th>Email Người Dùng</th>
                    @endif
                    <th>Ngày Đặt Hàng</th>
                    <th>Tổng Giá</th>
                    <th>Địa Chỉ Giao Hàng</th>
                    <th>Ghi Chú</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        @if (Gate::allows('admin'))
                            <td>{{ $order->user->id }}</td>
                            <td>{{ $order->user->email }}</td>
                        @endif
                        <td>{{ $order->order_date }}</td>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                        <td>{{ $order->ship_address }}</td>
                        <td>{{ $order->notes }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            @php
                                $isDisabled = in_array($order->status, ['completed', 'canceled']);
                            @endphp

                            @if (Gate::allows('admin'))
                                <!-- Edit Icon -->
                                <a href="{{ $isDisabled ? '#' : route('orders.edit', $order->id) }}" 
                                   class="icon-btn edit-btn {{ $isDisabled ? 'disabled-link' : '' }}" 
                                   {{ $isDisabled ? 'onclick=event.preventDefault()' : '' }}>
                                   <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Delete Icon -->
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="icon-btn delete-btn {{ $isDisabled ? 'disabled-link' : '' }}" 
                                            {{ $isDisabled ? 'disabled' : '' }}>
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            @elseif (Auth::id() == $order->user_id)
                                <!-- Cancel Order -->
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm {{ $isDisabled ? 'disabled-link' : '' }}" 
                                            {{ $isDisabled ? 'disabled' : '' }}>
                                        <i class="bi bi-x-circle"></i> Huỷ đơn
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- Add Bootstrap Icons if not already included -->
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush

<style>
    .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .container:hover {
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.15);
        }
    .table {
        width: 95%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table th {
        background-color: #6b46c1;
        color: #fff;
        font-weight: bold;
    }

    .table td {
        background-color: #ffffff;
        color: #212529;
    }

    .table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .d-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .custom-input {
        width: 220px;
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .custom-input:focus {
        border-color: #6b46c1;
        box-shadow: 0 0 5px rgba(107, 70, 193, 0.5);
    }

    .custom-btn {
        background-color: #6b46c1;
        border: none;
        padding: 10px 20px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #5a37a1;
        transform: scale(1.05);
    }

    .btn-secondary.custom-btn {
        background-color: #6c757d;
    }

    .btn-secondary.custom-btn:hover {
        background-color: #5a6268;
    }

    .disabled-link {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Icon Buttons */
    .icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        transition: all 0.3s ease;
        margin-right: 5px;
    }

    .edit-btn {
        background-color: #ffc107;
    }

    .edit-btn:hover {
        background-color: #e0a800;
        transform: scale(1.1);
    }

    .delete-btn {
        background-color: #dc3545;
    }

    .delete-btn:hover {
        background-color: #c82333;
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 14px;
        }

        .custom-input {
            width: 180px;
        }

        .d-flex {
            gap: 10px;
        }
    }
</style>
