<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return Category::all();
    }

    public function getAllCats() {
        return Category::all()->map(function ($cat) {
            return [
               'value' => $cat['id'],
                'text' => $cat['name']
            ];
        });
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
        return response()->json(['message' => 'updated successfully'],200);
    }


    public function delete(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }


    public function show(Category $category) {
        return $category;

    }


}
