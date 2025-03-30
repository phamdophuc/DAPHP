<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách danh mục.
     */
    public function index()
    {
        $categories = Category::all();

        // Kiểm tra role để hiển thị đúng view
        $view = Auth::user()->role === 'admin' ? 'admin.categories.index' : 'user.categories.index';

        return view($view, compact('categories'));
    }

    /**
     * Hiển thị form tạo danh mục (chỉ admin).
     */
    public function create()
    {
        $this->authorizeAction();
        return view('admin.categories.create');
    }

    /**
     * Lưu danh mục mới vào cơ sở dữ liệu (chỉ admin).
     */
    public function store(Request $request)
    {
        $this->authorizeAction();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được tạo.');
    }

    /**
     * Hiển thị form chỉnh sửa danh mục (chỉ admin).
     */
    public function edit($id)
    {
        $this->authorizeAction();

        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Cập nhật danh mục trong cơ sở dữ liệu (chỉ admin).
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAction();

        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được cập nhật.');
    }

    /**
     * Xoá danh mục (chỉ admin).
     */
    public function destroy($id)
    {
        $this->authorizeAction();

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được xoá.');
    }

    /**
     * Hiển thị chi tiết danh mục (dành cho cả user và admin).
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $view = Auth::user()->role === 'admin' ? 'admin.categories.show' : 'user.categories.show';

        return view($view, compact('category'));
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
