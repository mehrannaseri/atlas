<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class Tag extends Model
{
    use HasRoles;
    protected $guard_name = 'web';
    protected $fillable = ['title' , 'lang_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function lang()
    {
        return $this->belongsTo(Language::class);
    }
}
