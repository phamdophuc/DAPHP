@extends('layouts.app')
<style>
    /* order-form.css */

.container {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
    color: #444;
}

.form-control {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    background-color: #fdfdfd;
}

.form-control[disabled] {
    background-color: #f5f5f5;
    color: #666;
}

.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 4px rgba(40, 167, 69, 0.5);
}

.btn-success {
    width: 100%;
    padding: 12px;
    font-size: 18px;
    background-color: #28a745;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-success:hover {
    background-color: #218838;
}

</style>
@section('content')
<div class="container">
    <h1>Edit Order</h1>
    
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id">Order ID</label>
            <input type="text" id="id" class="form-control" value="{{ $order->id }}" disabled>
        </div>

        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="text" id="user_id" class="form-control" value="{{ $order->user->id }}" disabled>
            <input type="hidden" name="user_id" value="{{ $order->user->id }}">
        </div>

        <div class="form-group">
            <label for="user_email">User Email</label>
            <input type="text" id="user_email" class="form-control" value="{{ $order->user->email }}" disabled>
        </div>
        <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="datetime-local" id="order_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($order->order_date)) }}" disabled>
            <input type="hidden" name="order_date" value="{{ $order->order_date }}">
        </div>

        <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="number" id="total_price" class="form-control" value="{{ $order->total_price }}" disabled>
            <input type="hidden" name="total_price" value="{{ $order->total_price }}">
        </div>

        <div class="form-group">
            <label for="ship_address">Ship Address</label>
            <input type="text" id="ship_address" class="form-control" value="{{ $order->ship_address }}" disabled>
            <input type="hidden" name="ship_address" value="{{ $order->ship_address }}">
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <input type="text" name="notes" id="notes" value="{{ $order->notes }}" class="form-control" disabled>
            <input type="hidden" name="notes" value="{{ $order->notes }}"> 
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
