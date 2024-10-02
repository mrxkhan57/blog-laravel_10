<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function about() {
        return view('about');
    }

    public function team() {
        return view('team');
    }

    public function gallery() {
        return view('gallery');
    }

    public function news() {
        $data['getRecord'] = Blog::getRecordFront();
        return view('news', $data);
    }

    public function blogdetail($slug){
        $getRecord = Blog::getRecordSlug($slug);
        if(!empty($getRecord)){
            $data['getCategory'] = Category::getCategory();
            $data['getRecentPost'] = Blog::getRecentPost();
            $data['getRelatedPost'] = Blog::getRelatedPost($getRecord->category_id, $getRecord->id);
            $data['getRecord'] = $getRecord;
            return view('blog_detail', $data);
        }
        else {
            abort(404);
        }

    }

    public function contact() {
        return view(view: 'contact');
    }

}
