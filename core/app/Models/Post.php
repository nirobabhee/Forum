<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $casts = [
        'tags' => 'object'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategories()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('id', 'DESC');
    }
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }


}
