<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{ 
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền thực hiện thao tác này.');
        }
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo.');
    }

    public function edit($id)
    {
        $this->authorizeAdmin();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã bị xóa.');
    }
}
