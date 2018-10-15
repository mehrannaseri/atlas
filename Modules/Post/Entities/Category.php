<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title' , 'lang_id' , 'parent_id'];

    public function Post()
    {
        return $this->hasMany(Post::class);
    }
}
