@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order List</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
            @if (Gate::allows('admin'))
                <th>ID</th>
                <th>User Id</th>
            @endif
                <th>UserEmail</th>
                <th>Order Date</th>
                <th>Total Price</th>
                <th>Ship Address</th>
                <th>Notes</th>
                <th>Status</th>
                @if (Gate::allows('admin'))
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>    
                    @if (Gate::allows('admin'))
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->id }}</td>
                    @endif
                    <td>{{ $order->user->email }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->ship_address }}</td>
                    <td>{{ $order->notes }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    @if (Gate::allows('admin'))
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
