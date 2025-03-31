<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;

class OrderDetailController extends Controller
{

    public function index()
    {
        if (Gate::allows('is-admin')) {
            $orderDetails = OrderDetail::with(['order', 'product'])->get(); 
        } else {
            $orderDetails = OrderDetail::whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })->with(['order', 'product'])->get();
        }

        return view('order_details.index', compact('orderDetails'));
    }

    public function create()
    {
        Gate::authorize('is-admin');

        $orders = Order::all();
        $products = Product::all();
        return view('order_details.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        Gate::authorize('is-admin');

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        OrderDetail::create($request->all());

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được tạo.');
    }

    public function edit($id)
    {
        Gate::authorize('is-admin');

        $orderDetail = OrderDetail::findOrFail($id);
        $orders = Order::all();
        $products = Product::all();

        return view('order_details.edit', compact('orderDetail', 'orders', 'products'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('is-admin');

        $orderDetail = OrderDetail::findOrFail($id);

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderDetail->update($request->all());

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được cập nhật.');
    }

    public function destroy($id)
    {
        Gate::authorize('is-admin');

        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được xóa.');
    }
}
