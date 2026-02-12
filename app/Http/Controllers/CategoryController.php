<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // List all categories

    public function index()
{
    $categories = Category::orderBy('id', 'asc')->paginate(5);
    return view('pages.erp.categories.index', compact('categories'));
}




    // Show create form
    public function create() {
        return view('pages.erp.categories.create');
    }

    // Store new category
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'nullable',
            'status' => 'nullable|boolean'
        ]);

        // Mass assignment protection + status handling
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    // Show edit form
    public function edit(Category $category) {
        return view('pages.erp.categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
            'description' => 'nullable',
            'status' => 'nullable|boolean'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
