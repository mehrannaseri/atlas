<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
