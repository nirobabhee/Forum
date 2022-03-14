<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
