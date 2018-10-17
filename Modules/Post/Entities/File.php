<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['file_url' , 'description'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
