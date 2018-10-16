<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['title' , 'flag'];

    public function categories()
    {
        return $this->hasMany(Category::class , 'lang_id');
    }
}
