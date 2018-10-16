<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title' , 'lang_id' , 'parent_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function lang()
    {
        return $this->belongsTo(Language::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class , 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(self::class , 'parent_id');
    }
}
