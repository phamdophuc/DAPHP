<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        dd(Gate::allows('is-admin')); // Kiểm tra xem Laravel có nhận diện quyền không
        Gate::authorize('is-admin');
        return view('products.create');;
    }

    public function store(Request $request)
    {
        Gate::authorize('is-admin');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo.');
    }

    public function edit($id)
    {
        Gate::authorize('is-admin');

        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('is-admin');

        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật.');
    }


    public function destroy($id)
    {
        Gate::authorize('is-admin');

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xoá.');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }
}
