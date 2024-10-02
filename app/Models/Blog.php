<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        //'category_id',
        //'slug',''
        'image_file',
        'description',
        'tags',
        'meta_description',
        'meta_keywords',
        'status',
        'is_publish',

    ];

    protected $casts = [

        'status' => 'boolean',
        'is_publish' => 'boolean',
    ];

    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    /**
     * Define the delete status values
     */
    const PUBLISH = 1;
    const NON_PUBLISH = 0;


    public function getStatusAttribute(): string
    {
        return $this->attributes['status'] === self::ACTIVE_STATUS ? 'Active' : 'Inactive';
    }

    public function getIsPublishAttribute(): string
    {
        return $this->attributes['is_publish'] === self::PUBLISH ? 'Yes' : 'No';
    }

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecordSlug($slug){
        return self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name')
        ->join('users', 'users.id', '=', 'blogs.user_id')
        ->join('categories', 'categories.id', '=', 'blogs.category_id')
        ->where('blogs.status', '=', 1)
        ->where('blogs.is_publish', '=', 1)
        ->where('blogs.slug', '=', $slug)
        ->first();
    }

    static public function getRecordFront(){
        $return = self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name')
        ->join('users', 'users.id', '=', 'blogs.user_id')
        ->join('categories', 'categories.id', '=', 'blogs.category_id');

        if(!empty(request()->get('q')))
        {
            $return = $return->where('blogs.title', 'like', '%'.request()->get('q').'%');
        }

        $return = $return->where('blogs.status', '=', 1)
        ->where('blogs.is_publish', '=', 1)
        ->orderBy('blogs.id', 'desc')
        ->paginate(3);

        return $return;
    }

    static public function getRecentPost(){
        return self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name')
        ->join('users', 'users.id', '=', 'blogs.user_id')
        ->join('categories', 'categories.id', '=', 'blogs.category_id')
        ->where('blogs.status', '=', 1)
        ->where('blogs.is_publish', '=', 1)
        ->orderBy('blogs.id', 'desc')
        ->limit(3)
        ->get();
    }

    static public function getRelatedPost($category_id, $id){
        return self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name')
        ->join('users', 'users.id', '=', 'blogs.user_id')
        ->join('categories', 'categories.id', '=', 'blogs.category_id')
        ->where('blogs.id', '!=', $id)
        ->where('blogs.category_id', '=', $category_id)
        ->where('blogs.status', '=', 1)
        ->where('blogs.is_publish', '=', 1)
        ->orderBy('blogs.id', 'desc')
        ->limit(5)
        ->get();
    }

    static public function getRecord(){

        $return = self::select('blogs.*', 'users.name as user_name', 'categories.name as category_name')
        ->join('users', 'users.id', '=', 'blogs.user_id')
        ->join('categories', 'categories.id', '=', 'blogs.category_id');

        if(!empty(Auth::check()) && Auth::user()->is_admin != 1){
            $return->where('blogs.user_id', '=', Auth::user()->id);
        }

        if(!empty(request()->get('id'))){
            $return->where('blogs.id', '=', request()->get('id'));
        }
        if(!empty(request()->get('username'))){
            $return->where('users.name', 'like','%'.request()->get('username').'%');
        }
        if(!empty(request()->get('title'))){
            $return->where('blogs.title', 'like','%'.request()->get('title').'%');
        }
        if(!empty(request()->get('category'))){
            $return->where('categories.name', 'like','%'.request()->get('category').'%');
        }

        if(!empty(request()->get('status'))){
            $status = request()->get('status');
            if($status == 100){
                $status = 0;
            }
            $return->where('blogs.status', '=' ,$status);
        }

        if(!empty(request()->get('is_publish'))){
            $is_publish = request()->get('is_publish');
            if($is_publish == 100){
                $is_publish = 0;
            }
            $return->where('blogs.is_publish', '=' ,$is_publish);
        }

        if(!empty(request()->get('start_date'))){
            $return->whereDate('blogs.created_at', '>=', request()->get('start_date'));
        }

        if(!empty(request()->get('end_date'))){
            $return->whereDate('blogs.created_at', '<=', request()->get('end_date'));
        }

        if(!empty(Auth::check()) && Auth::user()->is_admin != 1){
            $return = $return->where('is_publish', '=', self::PUBLISH);
        }
        $return = $return
        ->orderBy('blogs.id', 'desc')
        ->paginate(10);

        return $return;
    }

    //->where('is_publish', '=', self::PUBLISH)

    public function getImage(){
        if(!empty($this->image_file) && file_exists('upload/blog/'.$this->image_file)){
            return url('upload/blog/'.$this->image_file);
        }
        else {
            return "";
        }
    }
}
