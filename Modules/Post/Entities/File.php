<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
