<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Api\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return response()->json(['message' => 'Category created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $request->validate([
            'name' => 'required',
        ]);

        $category->name = $request->name;
        $category->save();

        return response()->json(['message' => 'Category updated successfully']);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
