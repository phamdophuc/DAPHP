<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Display a listing of the orders
    public function index()
    {
        $user = Auth::user(); // 🔹 Lấy user đang đăng nhập

        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem lịch sử đơn hàng.');
        }

        if ($user->role && $user->role->name === 'admin') {
            $orders = Order::with('user')->latest()->get(); // 🔹 Admin xem tất cả đơn hàng
        } else {
            $orders = Order::where('user_id', $user->id)->latest()->get(); // 🔹 User chỉ xem đơn hàng của họ
        }
        return view('orders.index', compact('orders'));
    }

    // Show the form for creating a new order
    public function create()
    {
        return view('orders.create');
    }

    // Store a newly created order in storage
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

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Show the form for editing the specified order
    public function edit($id)
    {
        $order = Order::find($id);
        $users = User::all();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }

        return view('orders.edit', compact('order',  'users'));
    }

    // Update the specified order in storage
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }

        $order->update([
            'user_id' => $request->user_id ?? $order->user_id,
            'order_date' => $request->order_date ?? $order->order_date,
            'total_price' => $request->total_price ?? $order->total_price,
            'ship_address' => $request->ship_address ?? $order->ship_address,
            'notes' => $request->notes ?? $order->notes,
            'status' => $request->status, 
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }


    // Remove the specified order from storage
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
