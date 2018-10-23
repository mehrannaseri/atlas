<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasRoles;

    protected  $guard_name = 'web';
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
