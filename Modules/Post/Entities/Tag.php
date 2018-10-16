<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function lang()
    {
        return $this->belongsTo(Language::class);
    }
}
