<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{
    /**
     * Display a listing of the brands.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }
    protected function checkAdmin()
    {
        if (Gate::denies('admin')) {
            redirect()->route('access.denied')->send();
        }
    }
    /**
     * Show the form for creating a new brand.
     */
    public function create()
    {
        $this->checkAdmin();
        return view('brands.create');
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Brand::create($request->all());

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit($id)
    {
        $this->checkAdmin();
        $brand = Brand::findOrFail($id);

        if (!$brand) {
            return redirect()->route('brands.index')->with('error', 'Brand not found');
        }
        
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand->update($validated);

        return redirect()->route('brands.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy($id)
    {
        $this->checkAdmin();
        $brand = Brand::find($id);

        if (!$brand) {
            return redirect()->route('brands.index')->with('error', 'Brand not found');
        }

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
