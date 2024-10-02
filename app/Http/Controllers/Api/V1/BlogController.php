<?php


namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Api\Blog;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        if (empty($blog)) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }
        return response()->json($blog);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->category_id = $request->category_id;
        $blog->description = $request->description;
        $blog->save();

        return response()->json(['message' => 'Blog post created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        if (empty($blog)) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $blog->title = $request->title;
        $blog->category_id = $request->category_id;
        $blog->description = $request->description;
        $blog->save();

        return response()->json(['message' => 'Blog post updated successfully']);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        if (empty($blog)) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }
        $blog->delete();
        return response()->json(['message' => 'Blog post deleted successfully']);
    }
}
