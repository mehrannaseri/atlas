<?php

namespace Modules\Post\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id' , 'comment' , 'user_id'];

    public function post()
    {
        return $this->$this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
