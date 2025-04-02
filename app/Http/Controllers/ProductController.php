<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index(Request $request)
    {
        $filters = $request->only(['query', 'category_id', 'brand_id', 'min_price', 'max_price']);

        $products = Product::filter($filters)
            ->with(['category', 'brand'])
            ->orderBy('created_date', 'desc')
            ->paginate(10)
            ->appends(request()->query());

        $categories = Category::all();
        $brands = Brand::all();

        return view('products.index', compact('products', 'categories', 'brands', 'filters'));
    }

        protected function checkAdmin()
    {
        if (Gate::denies('admin')) {
            abort(403, 'Bạn không có quyền truy cập!');
        }
    }
    // Hiển thị form tạo sản phẩm mới
    public function create()
    {
        $this->checkAdmin();
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create', compact('categories', 'brands'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'promotion_price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'is_hot' => 'boolean',
            'hot_start_date' => 'nullable|date_format:Y-m-d\TH:i', 
            'hot_end_date' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:hot_start_date',
            'seo_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if (!Storage::exists('public/products')) {
            Storage::makeDirectory('public/products');
        }

        $data = $request->all();
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('products', 'public');
            $data['image_url'] = $imagePath;
        }

        $data['hot_start_date'] = $request->hot_start_date ? date('Y-m-d H:i:s', strtotime($request->hot_start_date)) : null;
        $data['hot_end_date'] = $request->hot_end_date ? date('Y-m-d H:i:s', strtotime($request->hot_end_date)) : null;

        $data['created_by'] = Auth::id();
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->checkAdmin();
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'promotion_price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'is_hot' => 'boolean',
            'hot_start_date' => 'nullable|date_format:Y-m-d\TH:i',
            'hot_end_date' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:hot_start_date',
            'seo_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if (!Storage::exists('public/products')) {
            Storage::makeDirectory('public/products');
        }

        $data = $request->all();
        if ($request->hasFile('image_url')) {
            if ($product->image_url && Storage::exists('public/' . $product->image_url)) {
                Storage::delete('public/' . $product->image_url);
            }
    
            $imagePath = $request->file('image_url')->store('products', 'public');
            $data['image_url'] = $imagePath;
        }

        $data['hot_start_date'] = $request->hot_start_date ? date('Y-m-d H:i:s', strtotime($request->hot_start_date)) : null;
        $data['hot_end_date'] = $request->hot_end_date ? date('Y-m-d H:i:s', strtotime($request->hot_end_date)) : null;

        $data['updated_by'] = Auth::id();
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->checkAdmin();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã bị xóa.');
    }
}
