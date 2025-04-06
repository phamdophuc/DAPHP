@extends('layouts.app')
<style>
    /* General Table Styles */
.table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 12px;
    text-align: left;
    vertical-align: middle;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: bold;
}

.table td {
    background-color: #ffffff;
    color: #212529;
}

/* Form Filter Styling */
.d-flex .form-control {
    border-radius: 5px;
}

.d-flex .btn {
    border-radius: 5px;
}

/* Buttons Styling */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

/* Form Row and Input Fields */
.d-flex.mb-4.flex-wrap {
    gap: 10px;
}

.d-flex.mb-4 .form-control {
    margin-right: 10px;
}

/* Table row hover effect */
.table tbody tr:hover {
    background-color: #f1f1f1;
}

table th, table td {
    border: 1px solid #dee2e6;
}

/* For Admin Action Buttons */
.btn-sm {
    font-size: 12px;
    padding: 5px 10px;
}

form {
    display: inline-block;
}

.disabled-link {
    pointer-events: none;
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
@section('content')
<div class="container">
    <h1>Order List</h1>
    @if (Gate::allows('admin'))
        <form action="{{ route('orders.index') }}" method="GET" class="d-flex mb-4 flex-wrap align-items-center">
            <input type="text" name="order_id" class="form-control me-2 mb-2" style="width: 150px;" placeholder="Order ID" value="{{ request('order_id') }}">
            <input type="text" name="user_id" class="form-control me-2 mb-2" style="width: 150px;" placeholder="User ID" value="{{ request('user_id') }}">
            <input type="text" name="email" class="form-control me-2 mb-2" style="width: 200px;" placeholder="Email người dùng" value="{{ request('email') }}">
            
            <button type="submit" class="btn btn-primary me-2 mb-2">Tìm kiếm</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-2">Reset</a>
        </form>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>ID</th>
            @if (Gate::allows('admin'))
                <th>User Id</th>
                <th>UserEmail</th>
            @endif
                <th>Order Date</th>
                <th>Total Price</th>
                <th>Ship Address</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Actions</th>

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
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->ship_address }}</td>
                    <td>{{ $order->notes }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        @php
                            $isDisabled = in_array($order->status, ['completed', 'canceled']);
                        @endphp

                        @if (Gate::allows('admin'))
                            <a href="{{ $isDisabled ? '#' : route('orders.edit', $order->id) }}"
                                class="btn btn-warning btn-sm {{ $isDisabled ? 'disabled-link' : '' }}"
                                {{ $isDisabled ? 'onclick=event.preventDefault()' : '' }}>
                                Edit
                            </a>

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="btn btn-danger btn-sm {{ $isDisabled ? 'disabled-link' : '' }}" 
                                    {{ $isDisabled ? 'disabled' : '' }}>
                                    Delete
                                </button>
                            </form>

                        @elseif (Auth::id() == $order->user_id)
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                    class="btn btn-danger btn-sm {{ $isDisabled ? 'disabled-link' : '' }}" 
                                    {{ $isDisabled ? 'disabled' : '' }}>
                                    Huỷ đơn
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
