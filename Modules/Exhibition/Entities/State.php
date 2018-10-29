<?php

namespace Modules\Exhibition\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class State extends Model
{
    protected $guard_name = 'web';
    protected $fillable = ['title'];

    public function cities()
    {
        return $this->hasMany(City::class);

    }

    public function exhibitions()
    {
        return $this->hasMany(Exhibition::class);
    }
}
