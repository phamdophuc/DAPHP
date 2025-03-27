@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="date" name="order_date" id="order_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" name="total_price" id="total_price" class="form-control">
        </div>
        <div class="form-group">
            <label for="ship_address">Ship Address</label>
            <input type="text" name="ship_address" id="ship_address" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
