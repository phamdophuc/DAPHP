@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Order</h1>

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

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- User Selection --}}
        <div class="form-group mb-3">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $order->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Order Date --}}
        <div class="form-group mb-3">
            <label for="order_date">Order Date</label>
            <input type="date" name="order_date" id="order_date" class="form-control"
                   value="{{ old('order_date', $order->order_date) }}" required>
        </div>

        {{-- Total Price --}}
        <div class="form-group mb-3">
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" name="total_price" id="total_price" class="form-control"
                   value="{{ old('total_price', $order->total_price) }}" placeholder="Enter total price" required>
        </div>

        {{-- Shipping Address --}}
        <div class="form-group mb-3">
            <label for="ship_address">Ship Address</label>
            <input type="text" name="ship_address" id="ship_address" class="form-control"
                   value="{{ old('ship_address', $order->ship_address) }}" placeholder="Enter shipping address" required>
        </div>

        {{-- Order Status --}}
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ old('status', $order->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
