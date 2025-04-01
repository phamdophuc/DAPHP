<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng.
     */
    public function index()
    {
        return view('orders.index', compact('orders'));
    }

    /**
     * Hiển thị form tạo đơn hàng (chỉ admin).
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Lưu đơn hàng vào database (chỉ admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,completed,canceled',
            'total_price' => 'required|numeric|min:0',
            'order_date' => 'required|date',
            'ship_address' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được tạo.');
    }

    /**
     * Hiển thị chi tiết đơn hàng.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Hiển thị form chỉnh sửa đơn hàng (chỉ admin).
     */
    public function edit($id)
    {

        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Cập nhật đơn hàng (chỉ admin).
     */
    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,completed,canceled',
            'total_price' => 'required|numeric|min:0',
            'order_date' => 'required|date',
            'ship_address' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Cập nhật đơn hàng thành công.');
    }

    /**
     * Xoá đơn hàng (chỉ admin).
     */
    public function destroy($id)
    {

        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã bị xoá.');
    }
    public function cancel($id) {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'canceled']);
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã bị hủy.');
    }
    
    public function confirm($id) {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'confirmed']);
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xác nhận.');
    }
    
    public function complete($id) {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'completed']);
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã hoàn thành.');
    }
    
    public function return($id) {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'returned']);
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được trả lại.');
    }
    
}
