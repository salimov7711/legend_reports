<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|unique:categories|max:50'
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        return response()->json(['message' => 'created successfully'], 201);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $category->name = $request->input('name');
        $category->save();
        return response()->json(['message' => 'updated successfully'], 201);
    }


    public function delete(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'deleted successfully'], 201);
    }


    public function show(Category $category) {
        return $category;

    }


}
