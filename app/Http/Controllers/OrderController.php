<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $orders = Order::with('user')->get(); // Admin xem tất cả đơn hàng
            return view('admin.orders.index', compact('orders'));
        } 
        
        // User chỉ xem đơn hàng của mình
        $orders = Order::where('user_id', Auth::id())->get();
        return view('user.orders.index', compact('orders'));
    }

    /**
     * Hiển thị form tạo đơn hàng (chỉ admin).
     */
    public function create()
    {
        $this->authorizeAction();
        return view('admin.orders.create');
    }

    /**
     * Lưu đơn hàng vào database (chỉ admin).
     */
    public function store(Request $request)
    {
        $this->authorizeAction();

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,completed,canceled',
            'total_price' => 'required|numeric|min:0',
            'order_date' => 'required|date',
            'ship_address' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        Order::create($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được tạo.');
    }

    /**
     * Hiển thị chi tiết đơn hàng.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền truy cập đơn hàng này.');
        }

        $view = Auth::user()->role === 'admin' ? 'admin.orders.show' : 'user.orders.show';

        return view($view, compact('order'));
    }

    /**
     * Hiển thị form chỉnh sửa đơn hàng (chỉ admin).
     */
    public function edit($id)
    {
        $this->authorizeAction();

        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Cập nhật đơn hàng (chỉ admin).
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAction();

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

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật đơn hàng thành công.');
    }

    /**
     * Xoá đơn hàng (chỉ admin).
     */
    public function destroy($id)
    {
        $this->authorizeAction();

        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã bị xoá.');
    }

    /**
     * Kiểm tra quyền truy cập (chỉ cho phép admin).
     */
    private function authorizeAction()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền thực hiện thao tác này.');
        }
    }
}
