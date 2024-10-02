<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function category(){

        $data['active_class'] = 'category';
        $data['getRecord'] = Category::getRecord();
        return view('backend.category.list', $data);
    }

    public function add_category(Request $request){
        $data['active_class'] = 'category';
        return view('backend.category.add', $data);
    }

    public function edit_category($id){

        $data['active_class'] = 'category';
        $data['getRecord'] = Category::getSingle($id);
        return view('backend.category.edit', $data);

    }

    public function update_category($id, Request $request){

        request()->validate([
            'name' => 'required',
            //'slug' => 'required',
            'title' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',

        ]);

        $save = Category::getSingle($id);
        $save->name = trim($request->name);
        $save->slug = trim(Str::slug($request->name));
        $save->title = trim($request->title);
        $save->meta_title = trim($request->meta_title);
        $save->meta_description = trim($request->meta_description);
        $save->meta_keywords = trim($request->meta_keywords);
        $save->status = trim($request->status);
        $save->save();

        session()->flash('success', 'Category updated successfully!');
        return redirect()->route('category.list');

        //return redirect('panel/category/list')->with('success', 'Successfully updated');

    }

    public function delete_category($id){
        $save = Category::getSingle($id);
        //$save->is_delete = 1;
        $save->delete();
        //$save->save();

        return redirect()->back()->with('success', 'Successfully deleted');
    }

    public function insert_category(Request $request){

        request()->validate([
            'name' => 'required',
            //'slug' => 'required',
            'title' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

        $save = new Category;
        $save->name = trim($request->name);
        $save->slug = trim(Str::slug($request->name));
        $save->title = trim($request->title);
        $save->meta_title = trim($request->meta_title);
        $save->meta_description = trim($request->meta_description);
        $save->meta_keywords = trim($request->meta_keywords);
        $save->status = trim($request->status);
        $save->save();

        return redirect('panel/category/list')->with('success', 'Successfully added new category');
    }
}
