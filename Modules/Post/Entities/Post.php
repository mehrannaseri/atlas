<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Post extends Model
{
    protected $guard_name = 'web';
    protected $fillable = ['title' , 'body' , 'lang_id' , 'image_url' , 'user_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function lang()
    {
        return $this->belongsTo(Language::class , 'lang_id');
    }
}
