<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title' , 'body' , 'lang_id' , 'image_url' , 'user_id'];

    public function categories()
    {
        return $this->hasmany(Category::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
