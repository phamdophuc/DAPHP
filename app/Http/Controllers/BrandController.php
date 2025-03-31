<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        Gate::authorize('is-admin'); // Chặn nếu không phải admin
        return view('brands.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('is-admin');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Brand::create($request->all());

        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được tạo.');
    }

    public function edit($id)
    {
        Gate::authorize('is-admin');

        $brand = Brand::findOrFail($id);

        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('is-admin');

        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand->update($validated);

        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được cập nhật.');
    }

    public function destroy($id)
    {
        Gate::authorize('is-admin');

        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được xoá.');
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.show', compact('brand'));
    }
}
