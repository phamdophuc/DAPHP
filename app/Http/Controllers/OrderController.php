<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    protected function checkAdmin()
    {
        if (Gate::denies('admin')) {
            abort(403, 'Bạn không có quyền truy cập!');
        }
    }
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem lịch sử đơn hàng.');
        }
        
        if ($user->role && $user->role->name === 'admin') {
            $orders = Order::with('user')->latest()->get(); 
        } else {
            $orders = Order::where('user_id', $user->id)->latest()->get(); 
        }
        $query = Order::query()->with('user');

        if ($request->filled('order_id')) {
            $query->where('id', $request->input('order_id'));
        }
    
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }
    
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->input('email') . '%');
            });
        }
    
        $orders = $query->get();
        return view('orders.index', compact('orders'));
    }

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
