<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [];

    public function Post()
    {
        return $this->hasMany(Post::class);
    }
}
