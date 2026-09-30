<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::OrderBy('created_at', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    // public function store(Request $r) {
    //     Category::create($r->all());
    //     return redirect()->route('admin.categories.index');
    // }
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'slug' => 'required|string|unique:categories',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('categories', 'public');
    }

    Category::create($data);

    return redirect()->route('admin.categories.index')
                     ->with('success','Category created');
}

    public function edit(Category $category) {
        return view('admin.categories.edit', compact('category'));
    }

    // public function update(Request $r, Category $category) {
    //     $category->update($r->all());
    //     return redirect()->route('admin.categories.index');
    // }
public function update(Request $request, Category $category)
{
    $data = $request->validate([
        'name' => 'required|string',
        'slug' => 'required|string|unique:categories,slug,' . $category->id,
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة
        if ($category->image) {
            FacadesStorage::disk('public')->delete($category->image);
        }

        $data['image'] = $request->file('image')->store('categories', 'public');
    }

    $category->update($data);

    return redirect()->route('admin.categories.index')
                     ->with('success','Category updated');
}
    public function destroy(Category $category) {
        $category->delete();
        return back();
    }
}
