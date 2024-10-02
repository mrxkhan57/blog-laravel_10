<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function blog(){
        $data['getRecord'] = Blog::getRecord();
        return view('backend.blog.list', $data);
    }

    public function add_blog(){

        $data['getCategory'] = Category::getCategory();
        return view('backend.blog.add', $data);
    }

    public function insert_blog(Request $request){

        $save = new Blog;
        $save->title = trim($request->title);
        $save->user_id = Auth::user()->id;
        $save->category_id = trim($request->category_id);
        $save->description = trim($request->description);
        $save->tags = trim($request->tags);
        $save->meta_description = trim($request->meta_description);
        $save->meta_keywords = trim($request->meta_keywords);
        $save->is_publish = $request->has('is_publish') ? 1 : 0;
        $save->status =$request->has('status') ? 1 : 0;


        $slug = Str::slug($request->title);
        $checkSlug = Blog::where('slug', '=', $slug)->first();
        if (!empty($checkSlug)){
            $dbslug = Str::slug($request->title).'_'.$save->id;
        }
        else {
            $dbslug = $slug;
        }
        $save->slug = $dbslug;

        if(!empty($request->file('image_file'))){
            $ext =$request->file('image_file')->getClientOriginalExtension();
            $file = $request->file('image_file');
            $filename = $dbslug.'.'.$ext;
            $file -> move('upload/blog/', $filename);
            $save->image_file = $filename;
        }

        $save->save();

        return redirect('panel/blog/list')->with('success', 'News successfully addedd and checking by ADMIN! If there is no error then your added news will show!');

    }

    public function edit_blog($id){
        $data['getCategory'] = Category::getCategory();
        $data['getRecord'] = Blog::getSingle($id);
        return view('backend.blog.edit', $data);
    }

    public function show_blog($id){
        $data['getRecord'] = Blog::getSingle($id);
        //$category = Category::getCategory()->where('id', $data['getRecord']->category_id)->first();
        $category = Category::find($data['getRecord']->category_id);
        $data['category_name'] = $category->name;
        $user = User::find($data['getRecord']->user_id);
        $data['user_name'] = $user->name;
        //$data['description'] = strip_tags($data['getRecord']->description);
        return view('backend.blog.show', $data);
    }

    public function update_blog($id, Request $request){
        $save = Blog::getSingle($id);
        $save->title = trim($request->title);
        $save->category_id = trim($request->category_id);
        $save->description = trim($request->description);
        $save->tags = trim($request->tags);
        $save->meta_description = trim($request->meta_description);
        $save->meta_keywords = trim($request->meta_keywords);
        $save->is_publish = $request->has('is_publish') ? 1 : 0;
        $save->status =$request->has('status') ? 1 : 0;

        $slug = Str::slug($request->title);
        $checkSlug = Blog::where('slug', '=', $slug)->first();
        if (!empty($checkSlug)){
            $dbslug = Str::slug($request->title).'_'.$save->id;
        }
        else {
            $dbslug = $slug;
        }
        $save->slug = $dbslug;


        if(!empty($request->file('image_file'))){

            if(!empty($save->getImage())){
                unlink('upload/blog/'.$save->image_file);
            }

            $ext =$request->file('image_file')->getClientOriginalExtension();
            $file = $request->file('image_file');
            $filename = $save->slug.'.'.$ext;
            $file -> move('upload/blog/', $filename);
            $save->image_file = $filename;
        }

        $save->save();

        return redirect('panel/blog/list')->with('success', 'News successfully updated!');
    }

    public function delete_blog($id){
        $save = Blog::getSingle($id);
        $save->delete();
        return redirect('panel/blog/list')->with('success', 'News successfully deleted!');
    }
}
