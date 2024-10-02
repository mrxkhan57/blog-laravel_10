<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

class Category extends Model
{
    use HasFactory;

    //protected $table = 'categories';

    protected $fillable = [

        'name',
        //'slug',
        'title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'is_delete',

    ];

    protected $casts = [

        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];

    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    /**
     * Define the delete status values
     */
    const DELETED_STATUS = 1;
    const NOT_DELETED_STATUS = 0;


    public function getStatusAttribute(): string
    {
        return $this->attributes['status'] === self::ACTIVE_STATUS ? 'Active' : 'Inactive';
    }

    public function getIsDeleteAttribute(): string
    {
        return $this->attributes['is_delete'] === self::NOT_DELETED_STATUS ? 'Deleted' : 'Not Deleted';
    }

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord(){

        return self::select('categories.*')
        ->where('is_delete', '=', self::NOT_DELETED_STATUS)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    static public function getCategory(){
        return self::select('categories.*')
        ->where('status', '=', self::ACTIVE_STATUS)
        ->where('is_delete', '=', self::NOT_DELETED_STATUS)
        ->orderBy('categories.id', 'desc')
        ->get();
    }

    public function totalblog(){

        return $this->hasMany(Blog::class, 'category_id')
        ->where('blogs.status', '=', 1)
        ->where('blogs.is_publish', '=', 1)
        ->count();

    }
}
