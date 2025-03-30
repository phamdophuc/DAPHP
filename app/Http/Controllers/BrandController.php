<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::all();
        $view = Auth::user()->role === 'admin' ? 'admin.brands.index' : 'user.brands.index';

        return view($view, compact('brands'));
    }

    public function create()
    {
        $this->authorizeAction();
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAction();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Brand::create($request->all());

        return redirect()->route('admin.brands.index')->with('success', 'Thương hiệu đã được tạo.');
    }

    public function edit($id)
    {
        $this->authorizeAction();

        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAction();

        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand->update($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Thương hiệu đã được cập nhật.');
    }

    public function destroy($id)
    {
        $this->authorizeAction();

        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Thương hiệu đã được xoá.');
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);

        $view = Auth::user()->role === 'admin' ? 'admin.brands.show' : 'user.brands.show';

        return view($view, compact('brand'));
    }

    private function authorizeAction()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền thực hiện thao tác này.');
        }
    }
}
