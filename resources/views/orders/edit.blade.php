@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Order</h1>
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="date" name="order_date" id="order_date" value="{{ $order->order_date }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" name="total_price" id="total_price" value="{{ $order->total_price }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="ship_address">Ship Address</label>
            <input type="text" name="ship_address" id="ship_address" value="{{ $order->ship_address }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
