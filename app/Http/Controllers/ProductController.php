<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function create()
    {
        return view('products.create');
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Hiển thị chi tiết sản phẩm
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required|integer',
        'brand_id' => 'required|integer',
        'quantity' => 'required|integer',
        'status' => 'required|boolean',
    ]);

    $product->update($request->all());

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
