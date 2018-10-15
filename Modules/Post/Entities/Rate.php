<?php

namespace Modules\Post\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
