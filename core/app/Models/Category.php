<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class)->orderBy('id', 'DESC');
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function postsForHome()
    {
        return $this->hasMany(Post::class)->where('status')->orderBy('id', 'DESC')->limit(2)->with('user');
    }

}
